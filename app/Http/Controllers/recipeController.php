<?php

namespace App\Http\Controllers;

use App\category;
use App\image;
use App\recipe;
use App\recipe_comment;
use App\recipe_tag;
use App\save_recipe;
use App\tag;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\recipe_cat;

class recipeController extends Controller
{
    //PAGE CONTROLLER


    //ADMIN CONTROLLER
    public function getList()
    {
        $data = recipe::orderBy('id','DESC')->paginate(10);
        $cat = category::get();
        $status = recipe::select('status')->orderBy('status','ASC')->distinct()->get();
        return view('admin.recipe.list',['data'=>$data,'status'=>$status,'cat'=>$cat]);
    }

    public function returnStatus($id){
        $data = recipe::where('status',$id)->paginate(10);
        $cat = category::get();
        $status = recipe::select('status')->orderBy('status','ASC')->distinct()->get();
        return view('admin.recipe.list',['data'=>$data,'status'=>$status,'cat'=>$cat]);
    }

    public function getAddRecipe(){
        $cat = category::all();
        $tag = tag::all();
        return view('admin.recipe.add',['cat'=>$cat,'tag'=>$tag]);
    }

    public function postAddRecipe(Request $rq){
        $this->validate($rq,
            [
                'title' => 'required|min:3|',
                'cookTime' => 'required',
                'serveFor' => 'required',
                'direction' => 'required',
                'ingredients_hiden' => 'required'
            ],
            [
                'title.required' => 'Please type in the Recipe title',
                'title.max' => 'Title not less than 3 characters',
                'cookTime.required' => 'Please fill in cook time',
                'serveFor.required' => 'Please fill in serve',
                'direction.required' => 'Please fill in direction',
                'ingredients_hiden.required' => 'Please fill in ingredients'
            ]
        );
        $recipe = new recipe();
        $allPath = null;
        if($rq->hasFile('image')){
            foreach ($rq->file('image') as $img){
                $image = new image();
                $file_extension = $img->getClientOriginalExtension();
                if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                    return redirect('admin/recipe/add')->with('thongbao','Wrong file');
                }
                $name = $img->getClientOriginalName();
                $slug = Str::random(4)."_".$name;
                while(file_exists("upload/image".$slug))
                {
                    $slug = Str::random(4)."_".$name;
                }
                $img->move('upload/image',$slug);
                $image->slug = $slug;
                $image->url = "upload/image/".$slug;
                $image->id_user = Auth::user()->id;
                $image->save();
                if($allPath==null){
                    $allPath .= $slug;
                }
                else
                    $allPath .=";".$slug;
            }
            $recipe->img_thumb = $allPath;
        }
        $recipe->title = $rq->title;
        $recipe->slug = Str::slug($rq->title."-".Str::random(4), '-');
        $recipe->description = $rq->description;
        $recipe->status = $rq->rIsPublic;
        $recipe->step = $rq->direction;
        $recipe->serve_for = $rq->serveFor;
        $recipe->cook_time = $rq->cookTime;
        $recipe->cook_unit = $rq->cook_unit_select;
        $recipe->user_id = Auth::user()->id;
        $recipe->cat_id = $rq->category;
        $recipe->ingredients = $rq->ingredients_hiden;
        $recipe->ingredients_name = $rq->ingredients_hiden1;
        $recipe->save();

        foreach ($rq->tag as $i){
            $tag = new recipe_tag();
            $tag->id_recipe = $recipe->id;
            $tag->id_tag = $i;
            $tag->save();
        }
        return redirect('admin/recipe/add')->with('thongbao','Upload Successful');
    }


    public function getEditRecipe($id){
        $cat = category::all();
        $data = recipe::find($id);
        $tag = tag::all();
        $recipe_tag = recipe_tag::where('id_recipe',$id)->get();
        return view('admin.recipe.update',['cat'=>$cat,'tag'=>$tag,'data'=>$data,'recipe_tag'=>$recipe_tag]);
    }

    public function EditRecipe(Request $rq,$id){
        $this->validate($rq,
            [
                'title' => 'required|min:3|',
                'category' =>'required',
                'cookTime' => 'required',
                'serveFor' => 'required',
                'direction' => 'required',
            ],
            [
                'title.required' => 'Please type in the Recipe title',
                'title.max' => 'Title not less than 3 characters',
                'category.required' => 'Please select category title',
                'cookTime.required' => 'Please fill in cook time',
                'serveFor.required' => 'Please fill in serve',
                'direction.required' => 'Please fill in direction',
            ]
        );
        $allPath = "";
        $recipe = recipe::find($id);
        if($rq->hasFile('image')){
            foreach ($rq->file('image') as $img){
                $image = new image();
                $file_extension = $img->getClientOriginalExtension();
                if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                    return redirect('admin/recipe/add')->with('thongbao','Wrong file');
                }
                $name = $img->getClientOriginalName();
                $slug = Str::random(4)."_".$name;
                while(file_exists("upload/image".$slug))
                {
                    $slug = Str::random(4)."_".$name;
                }
                $img->move('upload/image',$slug);
                $image->slug = $slug;
                $image->url = "upload/image/".$slug;
                $image->id_user = Auth::user()->id;
                $image->save();
                if($allPath==null){
                    $allPath .= $slug;
                }
                else
                    $allPath .=";".$slug;
            }

            echo $allPath;
            $recipe->img_thumb = $allPath;
        }
        else{
            $recipe->title = $rq->title;
            $recipe->slug = Str::slug($rq->title."-".Str::random(4), '-');
            $recipe->description = $rq->description;
            $recipe->status = $rq->rIsPublic;
            $recipe->step = $rq->direction;
            $recipe->serve_for = $rq->serveFor;
            $recipe->cook_time = $rq->cookTime;
            $recipe->cook_unit = $rq->cook_unit_select;
            $recipe->user_id = Auth::user()->id;
            $recipe->cat_id = $rq->category;
            if($rq->ingredients_hiden=="" && $rq->old_ingredients!=""){
                $recipe->ingredients = $rq->old_ingredients;
            }else
                $recipe->ingredients = $rq->ingredients_hiden;
            if($rq->ingredients_hiden1 == "" && $rq->old_ingredients!=""){
                $recipe->ingredients = $rq->old_ingredients;
            }else
                $recipe->ingredients_name = $rq->ingredients_hiden1;
            $recipe->save();
//        foreach ($rq->tag as $i){
//            $data = recipe_tag::where('id_recipe','=',$id)->get();
//            foreach ($data as $l){
//                echo $l->id_recipe."-".$id;
//                if($l->id_recipe==$id && $l->id_tag =! $rq->tag){
//                    $l->delete();
//                    $new = new recipe_tag();
//                    $new->id_recipe = $id;
//                    $new->id_tag = $i;
//                    $new->save();
//                    echo $l->id_tag."->id_tag".$l->id_recipe;
//                }
//            }
///          $tag->id_recipe = $id;
//           $tag->id_tag = $i;
//           $tag->save();
//           echo $tag->id_recipe."-".$tag->id_tag."|";
//        }
            return redirect('admin/recipe/edit/id='.$id)->with('thongbao','Edit Successful');
        }
    }
    public function findRecipe(Request $rq){
        $tukhoa = $rq->keyword;
        $data = recipe::where('title','like','%'.$rq->keyword.'%')->paginate(10);
        $cat = category::get();
        $status = recipe::select('status')->orderBy('status','ASC')->distinct()->get();
        return view('admin.recipe.list',['data'=>$data,'tukhoa'=>$tukhoa,'status'=>$status,'cat'=>$cat]);
    }
    public function findRecipe_Cat($id){
        $data = recipe::where('cat_id','=',$id)->paginate(10);
        $cat = category::get();
        $status = recipe::select('status')->orderBy('status','ASC')->distinct()->get();
        return view('admin.recipe.list',['data'=>$data,'status'=>$status,'cat'=>$cat]);
    }

    public function delete($id){
        $recipe = recipe::find($id);
        $recipe->delete();
        return redirect('admin/recipe/list')->with('thongbao','Delete Successful');
    }
    //END ADMIN CONTROLLER

}

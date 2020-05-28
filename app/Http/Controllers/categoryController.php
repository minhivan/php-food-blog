<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\category;

class categoryController extends Controller
{
    //INDEX CONTROLLER





    //ADMIN CONTROLLER
    public function getList(){
        $cat = category::orderBy('id','ASC')->paginate(10);
        return view('admin.recipe_cat.list',['cat'=>$cat]);
    }
    public function getUpdateCat($id){
        $cat = category::find($id);
        return view('admin.recipe_cat.update',['cat'=>$cat]);
    }
    public function updateCat(Request $rq,$id){
        $cat = category::find($id);
        $this->validate($rq,
            [
                'ingre_name' => 'required|max:50|min:3'
            ],
            [
                'ingre_name.required' => 'Please type in category name',
                'ingre_name.max' => 'Category name not over 50 characters',
                'ingre_name.min' => 'Category name not under 3 characters',
            ]
        );
        $cat->title = $rq->ingre_name;
        $cat->slug = Str::slug($rq->ingre_name, '-');
        $cat->description = $rq->ingre_description;
        $cat->save();

        return redirect('admin/recipe/category/edit/id='.$id)->with('thongbao','Update Successful');

    }
    public function add(Request $rq){
        $this->validate($rq,
            [
                'ingre_name' => 'required|max:50|min:3'
            ],
            [
                'ingre_name.required' => 'Please type in category name',
                'ingre_name.max' => 'Category name not over 50 characters',
                'ingre_name.min' => 'Category name not under 3 characters',
            ]
        );
        $cat = new category();
        $cat->title = $rq->ingre_name;
        $cat->slug = Str::slug($rq->ingre_name, '-');
        $cat->description = $rq->ingre_description;
        $cat->save();

        return redirect('admin/recipe/category/list')->with('thongbao','Insert Successful');

    }

    public function delete($id){
        $cat = category::find($id);
        $cat->delete();
        return redirect('admin/recipe/category/list')->with('thongbao','Delete Successful');
    }

    function findRecipeCat(Request $rq){
        $tukhoa = $rq->keyword;
        $cat = category::where('title','like','%'.$rq->keyword.'%')->paginate(10);
        return view('admin.recipe_cat.list',['cat'=>$cat,'tukhoa'=>$tukhoa]);
    }


    // END ADMIN CONTROLLER
}

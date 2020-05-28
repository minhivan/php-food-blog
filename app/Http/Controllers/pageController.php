<?php

namespace App\Http\Controllers;

use App\category;
use App\group;
use App\image;
use App\recipe;
use App\recipe_comment;
use App\recipe_group;
use App\recipe_tag;
use App\save_recipe;
use App\tag;
use App\user;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class pageController extends Controller
{
    public function __construct()
    {
        $tagRand = tag::all()->random(5);
        $groupBanner = group::orderBy('id','DESC')->take(3)->get();
        view()->share(['groupBanner'=>$groupBanner,'tagRand'=>$tagRand]);
    }

    //RETURN INDEX PAGE
    public function getIndex()
    {
        $new = recipe::orderBy('updated_at', 'desc')->take(2)->get();
        $trend = recipe::where('cat_id', '=', 3)->get()->random(4);
        $pop = recipe::where('cat_id','=', 4)->get()->random(4);
        $tag = tag::all();
        return view('page.trangchu', ['tag'=>$tag,'new' => $new, 'trend' => $trend,'pop'=>$pop]);
    }

    //RETURN TAG PAGE
    public function getTag($slug)
    {
        $tag = tag::where('slug', '=', $slug)->get()->first();
        $id = $tag->id;
        $data = recipe_tag::where('id_tag', '=', $id)->paginate(12);
        return view('page.tag', ['tag' => $tag, 'data' => $data]);
    }

    //RETURN CATEGORY PAGE
    public function getCategory($slug)
    {
        $cat = category::where('slug', '=', $slug)->get()->first();
        $id = $cat->id;
        $allcat = category::all();
        $banner = recipe::where('cat_id', '=', $id)->orderBy('id', 'DESC')->take(2)->get();
        $data = recipe::where('cat_id', '=', $id)->paginate(12);
        return view('page.category', ['cat' => $cat, 'data' => $data, 'banner' => $banner,'allcat'=>$allcat]);
    }


    ///////// RECIPE PAGE ///////
    // SHOW RECIPE
    public function showRecipe($slug)
    {
        $data = recipe::where('slug', '=', $slug)->get()->first();
        $id = $data->id;
        $cmt = recipe_comment::where('recipe_id', '=', $id)->orderBy('updated_at', 'DESC')->paginate(10);
        if (Auth::user()) {
            $idUser = Auth::user()->id;
            $isSave = save_recipe::where('id_recipe', '=', $id)->where('id_user', '=', $idUser)->get()->first();
            return view('page.recipe', ['data' => $data, 'isSave' => $isSave, 'cmt' => $cmt]);
        } else {
            return view('page.recipe',['data' => $data,'cmt' => $cmt]);
        }
    }
    //RETURN UPLOAD PAGE
    public function getUpload()
    {
        $cat = category::get();
        $tag = tag::get();
        return view('page.upload', ['cat' => $cat, 'tag' => $tag]);
    }

    // UPLOAD RECIPE
    public function Upload(Request $rq)
    {
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
        if ($rq->hasFile('image')) {
            foreach ($rq->file('image') as $img) {
                $image = new image();
                $file_extension = $img->getClientOriginalExtension();
                if ($file_extension != 'jpg' && $file_extension != 'png' && $file_extension != 'jpeg') {
                    return redirect('admin/recipe/add')->with('thongbao', 'Wrong file');
                }
                $name = $img->getClientOriginalName();
                $slug = Str::random(4) . "_" . $name;
                while (file_exists("upload/image" . $slug)) {
                    $slug = Str::random(4) . "_" . $name;
                }
                $img->move('upload/image', $slug);
                $image->slug = $slug;
                $image->url = "upload/image/" . $slug;
                $image->id_user = Auth::user()->id;
                $image->save();
                if ($allPath == null) {
                    $allPath .= $slug;
                } else
                    $allPath .= ";" . $slug;
            }
            $recipe->img_thumb = $allPath;
        }
        $recipe->title = $rq->title;
        $recipe->slug = Str::slug($rq->title . "-" . Str::random(4), '-');
        $recipe->description = $rq->description;
        $recipe->status = $rq->rIsPublic;
        $recipe->step = $rq->direction;
        $recipe->serve_for = $rq->serveFor;
        $recipe->cook_time = $rq->cookTime;
        $recipe->cook_unit = $rq->cook_unit_select;
        $recipe->status = 0;
        $recipe->user_id = Auth::user()->id;
        $recipe->cat_id = $rq->category;
        $recipe->ingredients = $rq->ingredients_hiden;
        $recipe->ingredients_name = $rq->ingredients_hiden1;
        echo $rq->ingredients_hiden1;
        $recipe->save();

        foreach ($rq->tag as $i) {
            $tag = new recipe_tag();
            $tag->id_recipe = $recipe->id;
            $tag->id_tag = $i;
            $tag->save();
        }
        return redirect('page/upload/recipe')->with('thongbao', 'Upload Successful');
    }

    //RETURN ALL RECIPE
    public function showAllRecipe()
    {
        $new = recipe::orderBy('id', 'DESC')->take(2)->get();
        $cat = category::get();
        $data = recipe::paginate(12);
        return view('page.all',['data'=>$data,'new'=>$new,'cat'=>$cat]);
    }
    // RETURN EDIT POST
    public function getEditRecipe($slug)
    {
        $data = recipe::where('slug','=',$slug)->get()->first();
        if(Auth::user()->id == $data->user_id){
            $cat = category::get();
            $tag = tag::get();
            $recipe_tag = recipe_tag::where('id_recipe',$data->id)->get();
            return view('page.edit', ['data'=>$data,'cat' => $cat, 'tag' => $tag,'recipe_tag'=>$recipe_tag]);
        }
        else
            return view('404');

    }

    public function EditRecipe(Request $rq,$slug){
        $this->validate($rq,
            [
                'title' => 'required|min:3|',
                'category' =>'required',
                'cookTime' => 'required',
                'serveFor' => 'required',
            ],
            [
                'title.required' => 'Please type in the Recipe title',
                'title.max' => 'Title not less than 3 characters',
                'category.required' => 'Please select category title',
                'cookTime.required' => 'Please fill in cook time',
                'serveFor.required' => 'Please fill in serve'
            ]
        );
        $allPath = "";
        $recipe = recipe::where('slug','=',$slug)->get()->first();
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
            return redirect('page/edit/recipe/'.$recipe->slug)->with('thongbao','Edit Successful');
        }
    }

    ///////////SAVED DISHES PAGE/////////////
    // RETURN SAVE RECIPE
    public function getSaveRecipe()
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
            $data = save_recipe::where('id_user', '=', $id)->orderBy('id','DESC')->paginate(7);
            return view('page.save', ['data' => $data]);
        }
        else{
            return view('404');
        }
    }

    // CHECK SAVE RECIPE
    public function saveRecipe($id)
    {
        $recipe = recipe::find($id);
        $slug = $recipe->slug;
        $save = new save_recipe();
        $save->id_recipe = $id;
        $save->id_user = Auth::user()->id;
        $save->save();
        return redirect('page/recipe/' . $slug)->with('thongbao', 'SAVED');
    }
    // DELETE SAVE RECIPE
    public function delSaveRecipe($slug){
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
            $recipe = recipe::where('slug','=',$slug)->get()->first()->id;
            $save = save_recipe::where('id_recipe','=',$recipe)->where('id_user','=',$id)->get()->first();
            $save->delete();
            return redirect('page/save')->with('thongbao', 'Delete Successful');
        }
        else {
            return view('404');
        }
    }
    /////////// END /////////////

    // RETURN SEARCH RECIPE
    public function getSearch(Request $rq)
    {
        $str = $rq->search;
        $data = recipe::where('ingredients_name', 'like', '%' . $str . '%')->orWhere('title', 'like', '%' . $str . '%')->paginate(12);
        return view('page.search', ['data' => $data]);
    }


    ///////////MY BOARD PAGE/////////////
    // RETURN MY BOARD PAGE
    public function getMyboard()
    {
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
            $data = recipe::where('user_id', '=', $id)->where('status','=','1')->orderBy('created_at', 'DESC')->paginate(7);
            return view('page.myrecipe', ['data' => $data]);
        } else {
            return view('404');
        }
    }
    //FILTER TITLE BY A-Z
    public function getMyboardAlpha()
    {
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
            $data = recipe::where('user_id', '=', $id)->where('status','=','1')->orderBy('title', 'ASC')->paginate(7);
            return view('page.myrecipe', ['data' => $data]);
        } else {
            return view('404');
        }
    }
    // FILTER RECIPE WITH DRAFT STATUS
    public function getMyboardReview()
    {
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
            $data = recipe::where('user_id', '=', $id)->where('status','=','0')->paginate(7);
            return view('page.myrecipe', ['data' => $data]);
        } else {
            return view('404');
        }
    }

    ///////////END MY BOARD////////////////

    //DELETE RECIPE
    public function deleteMyRecipe($slug)
    {
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
            $recipe = recipe::where('slug','=',$slug)->get()->first();
            if ($recipe->user_id == $id) {
                $recipe->delete();
                return redirect('page/myboard')->with('thongbao', 'Delete Successful');
            }
            else {
                return view('404');
            }
        }
        else {
            return view('404');
        }
    }

    /////////// COLLECTION PAGE ///////////
    public function getCollection(){
        $tag = tag::all();
        $data = recipe_tag::groupBy('id_recipe')->paginate(12);
        return view('page.collection', ['tag' => $tag,'data'=>$data]);
    }


    // PROFILE PAGE //
    public function getProfile($login){
        if(user::where('login','=',$login)->get()->first()){
            if(Auth::user()->id == user::where('login','=',$login)->get()->first()->id){
                $accept = true;
                $user = user::where('login','=',$login)->get()->first();
                $cmt = recipe_comment::where('user_id','=',$user->id)->paginate(12);
                $data = recipe::where('user_id','=',$user->id)->paginate(12);
                return view('page.profile', ['cmt' => $cmt,'data' => $data,'user'=>$user,'accept'=>$accept]);
            }else{
                $accept = false;
                $user = user::where('login','=',$login)->get()->first();
                $cmt = recipe_comment::where('user_id','=',$user->id)->paginate(12);
                $data = recipe::where('user_id','=',$user->id)->paginate(12);
                return view('page.profile', ['cmt' => $cmt,'user'=>$user,'data' => $data,'accept'=>$accept]);
            }
        }
        else{
            return view('404');
        }
    }

    // EDIT PROFILE //
    public function EditProfile(Request $rq,$slug){
        $user = user::where('login','=',$slug)->get()->first();
        if($rq->retypepwd==null){
            if($user->email == $rq->user_email){
                $this->validate($rq,
                    [
                        'user_fname' => 'required|max:30|min:3|',
                        'user_lname' => 'required|max:30|min:3|'
                    ],
                    [
                        'user_fname.max' => 'First name not over than 30 characters',
                        'user_fname.min' => 'First name not less than 3 characters',
                        'user_lname.max' => 'Last name not over than 30 characters',
                        'user_lname.min' => 'Last name not less than 3 characters'
                    ]
                );
                $user->fname = $rq->user_fname;
                $user->lname = $rq->user_lname;
                $user->role = $rq->user_role;
                $user->bio = $rq->user_bio;
                if($rq->hasFile('user_thumbnail')){
                    $file = $rq->file('user_thumbnail');
                    $file_extension = $file->getClientOriginalExtension();
                    if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                        return redirect('page/profile/'.$slug)->with('thongbao','Wrong file');
                    }
                    $name = $file->getClientOriginalName();
                    $img = Str::random(4)."_".$name;
                    while(file_exists("upload/avatar".$img))
                    {
                        $img = Str::random(4)."_".$name;
                    }
                    $file->move('upload/avatar',$img);
                    $user->user_thumbnail = $img;
                    echo $img;
                }
                $user->save();

                return redirect('page/profile/'.$slug)->with('thongbao','Update Successful');
            }
            else{
                $this->validate($rq,
                    [
                        'user_fname' => 'required|max:30|min:3|',
                        'user_email' => 'required|email|unique:user,email',
                        'user_lname' => 'required|max:30|min:3|'
                    ],
                    [
                        'user_email.required' => 'Please type in email',
                        'user_email.email' => 'Please type in the correct email',
                        'user_email.unique' => 'This email has been used',
                        'user_fname.max' => 'First name not over than 30 characters',
                        'user_fname.min' => 'First name not less than 3 characters',
                        'user_lname.max' => 'Last name not over than 30 characters',
                        'user_lname.min' => 'Last name not less than 3 characters'
                    ]
                );
                $user->email = $rq->user_email;
                $user->fname = $rq->user_fname;
                $user->lname = $rq->user_lname;
                $user->role = $rq->user_role;
                $user->bio = $rq->user_bio;
                if($rq->hasFile('user_thumbnail')){
                    $file = $rq->file('user_thumbnail');
                    $file_extension = $file->getClientOriginalExtension();
                    if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                        return redirect('page/profile/'.$slug)->with('thongbao','Wrong file');
                    }
                    $name = $file->getClientOriginalName();
                    $img = Str::random(4)."_".$name;
                    while(file_exists("upload/avatar".$img))
                    {
                        $img = Str::random(4)."_".$name;
                    }
                    $file->move('upload/avatar',$img);
                    $user->user_thumbnail = $img;
                    echo $img;
                }
                $user->save();
                return redirect('page/profile/'.$slug)->with('thongbao','Update Successful');
            }
        }
        else{
            if($user->email == $rq->user_email){
                $this->validate($rq,
                    [
                        'user_pwd' => 'required|max:30|min:3|',
                        'user_fname' => 'required|max:30|min:3|',
                        'user_lname' => 'required|max:30|min:3|',
                        'retypepwd' => 'max:30|min:3|',
                    ],
                    [
                        'user_pwd.required' => 'Please type in password',
                        'user_pwd.min' => 'Password less than 3 characters',
                        'user_pwd.max' => 'Password not over than 30 characters',
                        'user_fname.max' => 'First name not over than 30 characters',
                        'user_fname.min' => 'First name not less than 3 characters',
                        'user_lname.max' => 'Last name not over than 30 characters',
                        'user_lname.min' => 'Last name not less than 3 characters',
                        'retypepwd.min' => 'Password less than 3 characters',
                        'retypepwd.max' => 'Password not over than 30 characters',
                    ]
                );
                $user->fname = $rq->user_fname;
                $user->lname = $rq->user_lname;
                $user->role = $rq->user_role;
                $user->bio = $rq->user_bio;
                $user->password = Hash::make($rq->retypepwd);
                if($rq->hasFile('user_thumbnail')){
                    $file = $rq->file('user_thumbnail');
                    $file_extension = $file->getClientOriginalExtension();
                    if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                        return redirect('page/profile/'.$slug)->with('thongbao','Wrong file');
                    }
                    $name = $file->getClientOriginalName();
                    $img = Str::random(4)."_".$name;
                    while(file_exists("upload/avatar".$img))
                    {
                        $img = Str::random(4)."_".$name;
                    }
                    $file->move('upload/avatar',$img);
                    $user->user_thumbnail = $img;
                    echo $img;
                }
                $user->save();

                return redirect('page/profile/'.$slug)->with('thongbao','Update Successful');
            }
            else{
                $this->validate($rq,
                    [
                        'user_pwd' => 'required|max:30|min:3|',
                        'user_fname' => 'required|max:30|min:3|',
                        'user_email' => 'required|email|unique:user,email',
                        'user_lname' => 'required|max:30|min:3|'
                    ],
                    [
                        'user_pwd.required' => 'Please type in password',
                        'user_pwd.min' => 'Password not over than 30 characters',
                        'user_pwd.max' => 'Password not less than 3 characters',
                        'user_email.required' => 'Please type in email',
                        'user_email.email' => 'Please type in the correct email',
                        'user_email.unique' => 'This email has been used',
                        'user_fname.max' => 'First name not over than 30 characters',
                        'user_fname.min' => 'First name not less than 3 characters',
                        'user_lname.max' => 'Last name not over than 30 characters',
                        'user_lname.min' => 'Last name not less than 3 characters'
                    ]
                );
                $user->email = $rq->user_email;
                $user->fname = $rq->user_fname;
                $user->lname = $rq->user_lname;
                $user->role = $rq->user_role;
                $user->bio = $rq->user_bio;
                $user->password = Hash::make($rq->retypepwd);
                if($rq->hasFile('user_thumbnail')){
                    $file = $rq->file('user_thumbnail');
                    $file_extension = $file->getClientOriginalExtension();
                    if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                        return redirect('page/profile/'.$slug)->with('thongbao','Wrong file');
                    }
                    $name = $file->getClientOriginalName();
                    $img = Str::random(4)."_".$name;
                    while(file_exists("upload/avatar".$img))
                    {
                        $img = Str::random(4)."_".$name;
                    }
                    $file->move('upload/avatar',$img);
                    $user->user_thumbnail = $img;
                    echo $img;
                }
                $user->save();

                return redirect('page/profile/'.$slug)->with('thongbao','Update Successful');
            }
        }

    }



    ////////////// COMMENT PAGE ///////////////
    public function Review(Request $rq,$slug,$id){

        $recipe = recipe::where('slug','=',$slug)->get()->first();
        $cmt = new recipe_comment();
        if($id == 1){
            $cmt->topic = 1;
            $cmt->recipe_id = $recipe->id;
            $cmt->user_id = Auth::user()->id;
            if($rq->hasFile('image')){
                $file = $rq->file('image');
                $file_extension = $file->getClientOriginalExtension();
                if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                    return redirect('page/recipe/'.$slug)->with('thongbao','Wrong file');
                }
                $name = $file->getClientOriginalName();
                $img = Str::random(4)."_".$name;
                while(file_exists("upload/image".$img))
                {
                    $img = Str::random(4)."_".$name;
                }
                $file->move('upload/image',$img);
                $cmt->img_url = $img;
            }
            else{
                $cmt->img_url = "";
            }
            $cmt->save();

            return redirect('page/recipe/'.$slug)->with('thongbao','Comment successfully');

        }elseif($id==2){
            $cmt->topic = 2;
            $cmt->recipe_id = $recipe->id;
            $cmt->user_id = Auth::user()->id;
            $cmt->content = $rq->comment;
            $this->validate($rq,
                [
                    'comment' => 'required|min:3|',

                ],
                [
                    'comment.required' => 'Please type in the Recipe title',
                    'comment.min' => 'Title not less than 3 characters',
                ]
            );
            if($rq->hasFile('image')){
                $file = $rq->file('image');
                $file_extension = $file->getClientOriginalExtension();
                if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                    return redirect('page/recipe/'.$slug)->with('thongbao','Wrong file');
                }
                $name = $file->getClientOriginalName();
                $img = Str::random(4)."_".$name;
                while(file_exists("upload/image".$img))
                {
                    $img = Str::random(4)."_".$name;
                }
                $file->move('upload/image',$img);
                $cmt->img_url = $img;
            }
            else{
                $cmt->img_url = "";
            }

            $cmt->save();
            return redirect('page/recipe/'.$slug)->with('thongbao','Comment successfully');

        }
        else{
            $cmt->topic = 3;
            $cmt->recipe_id = $recipe->id;
            $cmt->user_id = Auth::user()->id;
            $cmt->content = $rq->comment;
            $this->validate($rq,
                [
                    'comment' => 'required|min:3|',

                ],
                [
                    'comment.required' => 'Please type in the Recipe title',
                    'comment.min' => 'Title not less than 3 characters',
                ]
            );
            if($rq->hasFile('image')){
                $file = $rq->file('image');
                $file_extension = $file->getClientOriginalExtension();
                if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                    return redirect('page/recipe/'.$slug)->with('thongbao','Wrong file');
                }
                $name = $file->getClientOriginalName();
                $img = Str::random(4)."_".$name;
                while(file_exists("upload/image".$img))
                {
                    $img = Str::random(4)."_".$name;
                }
                $file->move('upload/image',$img);
                $cmt->img_url = $img;
            }
            else{
                $cmt->img_url = "";
            }

            $cmt->save();
            return redirect('page/recipe/'.$slug)->with('thongbao','Comment successfully');

        }
    }

    ///////// IDEA PAGE (GROUP RECIPE) //////////
    public function getGroup($slug){
        if(group::where('slug','=',$slug)->get()->first()->count()==0){
            return view ('404');
        }
        else{
            $group = group::where('slug','=',$slug)->get()->first();
            $data = recipe_group::where('id_group','=',$group->id)->paginate(10);
            return view ('page.event',['data'=>$data,'group' => $group]);
        }
    }

    ///////////// ADMIN CONTROLLER //////////////
    public function getDashboard(){
        $data = recipe::orderby('id','DESC')->take(5)->get();
        $cmt = recipe_comment::orderby('id','DESC')->take(5)->get();
        return view('admin.dashboard.index',['data'=>$data,'cmt'=>$cmt]);
    }



}

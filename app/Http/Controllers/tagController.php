<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\recipe_tag;
use App\thanhvien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\tag;

class tagController extends Controller
{
    //INDEX CONTROLLER





    //ADMIN CONTROLLER
    public function getList(){
        $tag = tag::orderBy('id','ASC')->paginate(10);
        $data = recipe_tag::all();
        return view('admin.recipe_tag.list',['tag'=>$tag,'data'=>$data]);
    }
    public function getUpdateTag($id){
        $tag = tag::find($id);
        return view('admin.recipe_tag.update',['tag'=>$tag]);
    }
    public function updateTag(Request $rq,$id){
        $tag = tag::find($id);
        $this->validate($rq,
            [
                'tag_name' => 'required|max:50|min:3'
            ],
            [
                'tag_name.required' => 'Please type in tag name',
                'tag_name.max' => 'Tag name not over 50 characters',
                'tag_name.min' => 'Tag name not under 3 characters',
            ]
        );
        $tag->title = $rq->tag_name;
        $tag->slug = Str::slug($rq->tag_name, '-');
        $tag->description = $rq->tag_description;
        $tag->save();

        return redirect('admin/recipe/tag/edit/id='.$id)->with('thongbao','Update Successful');

    }
    public function add(Request $rq){
        $this->validate($rq,
            [
                'tag_name' => 'required|max:50|min:3'
            ],
            [
                'tag_name.required' => 'Please type in tag name',
                'tag_name.max' => 'Tag name not over 50 characters',
                'tag_name.min' => 'Tag name not under 3 characters',
            ]
        );
        $tag = new tag();
        $tag->title = $rq->tag_name;
        $tag->slug = Str::slug($rq->tag_name, '-');
        $tag->description = $rq->tag_description;
        $tag->save();

        return redirect('admin/recipe/tag/list')->with('thongbao','Insert Successful');

    }

    public function delete($id){
        $tag = tag::find($id);
        $tag->delete();
        return redirect('admin/recipe/tag/list')->with('thongbao','Delete Successful');
    }

    function findRecipeTag(Request $rq){
        $tukhoa = $rq->keyword;
        $tag = tag::where('title','like','%'.$rq->keyword.'%')->paginate(10);
        return view('admin.recipe_tag.list',['tag'=>$tag,'tukhoa'=>$tukhoa]);
    }

    // END ADMIN CONTROLLER
}

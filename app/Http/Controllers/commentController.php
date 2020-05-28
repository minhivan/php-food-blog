<?php

namespace App\Http\Controllers;

use App\recipe_comment;
use App\thanhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class commentController extends Controller
{
    //RETURN COMMENT FOR RECIPE
    public function Comment(Request $rq,$id){
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
    }


    //ADMIN CONTROLLER
    public function getList(){
        $data = recipe_comment::orderBy('id','ASC')->paginate(10);
        $role = recipe_comment::select('topic')->orderBy('topic','ASC')->distinct()->get();
        return view('admin.comment.list',['data'=>$data,'role'=>$role]);
    }
    public function returnTopic($id){
        $data = recipe_comment::where('topic',$id)->paginate(10);
        $role = recipe_comment::select('topic')->orderBy('topic','ASC')->distinct()->get();
        return view('admin.comment.list',['data'=>$data,'role'=>$role]);
    }
    public function getUpdateCmt($id){
        $data = recipe_comment::find($id);
        return view('admin.comment.update',['data'=>$data]);
    }
    public function updateCmt(Request $rq,$id){
        $cmt = recipe_comment::find($id);
        $this->validate($rq,
            [
                'cmt_content' => 'required|min:3'
            ],
            [
                'cmt_content.required' => 'Please type in comment',
                'cmt_content.min' => 'Comment not under 3 characters',
            ]
        );
        $cmt->topic = $rq->cmt_topic;
        $cmt->content = $rq->cmt_content;
        $cmt->save();

        return redirect('admin/recipe/comment/edit/id='.$id)->with('thongbao','Update Successful');

    }

//
    public function delete($id){
        $data = recipe_comment::find($id);
        $data->delete();
        return redirect('admin/recipe/comment/list')->with('thongbao','Delete Successful');
    }
//
    function findRecipeCmt(Request $rq){
        $tukhoa = $rq->keyword;
        $data = recipe_comment::where('content','like','%'.$rq->keyword.'%')->paginate(10);
        $role = recipe_comment::select('topic')->orderBy('topic','ASC')->distinct()->get();
        return view('admin.comment.list',['data'=>$data,'tukhoa'=>$tukhoa],['role'=>$role]);
    }
//

    // END ADMIN CONTROLLER
}

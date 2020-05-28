<?php

namespace App\Http\Controllers;

use App\group;
use App\recipe;
use App\recipe_group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class groupController extends Controller
{
    //ADMIN CONTROLLER
    public function getList(){
        $group = group::orderBy('id','DESC')->paginate(10);
        $data = recipe_group::all();
        return view('admin.group.list',['group'=>$group,'data'=>$data]);
    }

    public function add(Request $rq){
        $this->validate($rq,
            [
                'group_name' => 'required|max:50|min:3'
            ],
            [
                'group_name.required' => 'Please type in tag name',
                'group_name.max' => 'Tag name not over 50 characters',
                'group_name.min' => 'Tag name not under 3 characters',
            ]
        );
        $group = new group();
        $group->title = $rq->group_name;
        $group->slug = Str::slug($rq->title."-".Str::random(4), '-');
        if($rq->hasFile('image')){
            $file = $rq->file('image');
            $file_extension = $file->getClientOriginalExtension();
            if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                return redirect('admin/recipe/group/list')->with('thongbao','Wrong file');
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4)."_".$name;
            while(file_exists("upload/image".$img))
            {
                $img = Str::random(4)."_".$name;
            }
            $file->move('upload/image',$img);
            $group->img_url = $img;
        }

        $group->save();
        return redirect('admin/recipe/group/list')->with('thongbao','Upload Successful');
    }

    public function getEdit($id){
        $group = group::find($id);
        $data = recipe::orderby('id','DESC')->paginate(7);
        return view('admin.group.edit',['group'=>$group,'data'=>$data]);
    }
    public function addRecipeGroup(Request $rq,$id){
        if($rq->keyword == null){
            foreach ($rq->recipe as $i){
                $data = new recipe_group();
                $data->id_group = $id;
                $data->id_recipe = $i;
                $data->save();
            }
            return redirect('admin/recipe/group/edit/id='.$id)->with('thongbao','Add Successful');
        }
        else{
            $group = group::find($id);
            $data = recipe::where('title','like','%'.$rq->keyword.'%')->paginate(10);
            return view('admin.group.edit',['group'=>$group,'data'=>$data]);
        }
    }

    public function groupDetails($id){
        if(group::find($id)->get()->count()==0){
            return view('404');
        }
        else{
            $group = group::find($id);
            $data = recipe_group::where('id_group','=',$id)->paginate(7);
            return view('admin.group.details',['group'=>$group,'data'=>$data]);
        }

    }

    public function delGroup($id){
        if(group::find($id)->get()->count()==0){
            return view('404');
        }
        else{
            $groupdel = group::find($id);
            $groupdel->delete();
            $group = group::orderBy('id','DESC')->paginate(10);
            $data = recipe_group::all();
            return redirect('admin/recipe/group/list')->with('thongbao','Delete Successful');
        }

    }

    public function delRecipeGroup($id1,$id2){
        $data = recipe_group::where('id_group','=',$id2)->paginate(7);
        $recipe = recipe_group::where('id_group','=',$id2)->where('id_recipe','=',$id1)->get()->first();
        $recipe->delete();
        $group = group::find($id2);
        return redirect('admin/recipe/group/details/id='.$id2)->with('thongbao','Delete Successful');
    }
}

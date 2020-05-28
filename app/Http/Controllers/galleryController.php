<?php

namespace App\Http\Controllers;

use App\image;
use App\recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;

class galleryController extends Controller
{
    //CONTROLLER


    //ADMIN CONTROLLER
    public function getList(){
        $data = image::orderBy('id','DESC')->paginate(10);
        return view('admin.media.list',['data'=>$data]);
    }

    public function getAddMedia(){
        return view('admin.media.upload',['user'=>Auth::user()->id]);
    }
    public function postAddMedia(Request $rq){
        $image = new image();
        if($rq->hasFile('image')){
            $file = $rq->file('image');
            $file_extension = $file->getClientOriginalExtension();
            if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                return redirect('admin/media/add')->with('thongbao','Wrong file');
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4)."_".$name;

            while(file_exists("upload/image".$img))
            {
                $img = Str::random(4)."_".$name;

            }
            $file->move('upload/image',$img);
            $image->slug = $img;
            $image->url = "upload/image/".$img;
            $image->id_user = Auth::user()->id;
            $image->save();
        }
        else{
            $image->slug = "";
            $image->url = "";
        }
        return redirect('admin/media/upload')->with('thongbao','Upload Successful');
    }
    public function getUpdateMedia($id){
        $data = image::find($id);
        return view('admin.media.update',['data'=>$data]);
    }

    public function UpdateMedia(Request $rq,$id){
        $image = image::find($id);
        if($rq->hasFile('image')){
            $file = $rq->file('image');
            $file_extension = $file->getClientOriginalExtension();
            if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                return redirect('admin/media/add')->with('thongbao','Wrong file');
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4)."_".$name;

            while(file_exists("upload/image".$img))
            {
                $img = Str::random(4)."_".$name;

            }
            $file->move('upload/image',$img);
            $image->slug = $img;
            $image->url = "upload/image/".$img;
            $image->id_user = Auth::user()->id;
            $image->save();
        }
        else{
            $image->slug = "";
            $image->url = "";
        }
        return redirect('admin/media/edit/id='.$id)->with('thongbao','Upload Successful');
    }

    public function delete($id){
        $img = image::find($id);
        $path = public_path()."/".$img->url;
        if(file_exists($path)){
            File::delete($path);
            $img->delete();
        }
        return redirect('admin/media/list')->with('thongbao','Delete Successful');
    }


    //END ADMIN CONTROLLER
}

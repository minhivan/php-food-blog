<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Controllers\Controller;
use App\recipe_cat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class userController extends Controller
{
    //LOGIN STATEMENT
    public function getLogin(){
        return view('page.login');
    }
    public function postLogin(Request $rq){
        $this->validate($rq,
            [
                'user_login' => 'required|max:30|min:3',
                'user_pwd' => 'required|max:30|min:3|'
            ],
            [
                'user_login.required' => 'Please type in user name',
                'user_login.unique' => 'This account has been used',
                'user_login.max' => 'User name not over than 30 characters',
                'user_login.min' => 'User name not less than 3 characters',
                'user_pwd.required' => 'Please type in password',
                'user_pwd.min' => 'Password not over than 30 characters',
                'user_pwd.max' => 'Password not less than 3 characters'

            ]
        );
        $cre = array('login'=>$rq->user_login,'password'=>$rq->user_pwd);
        if(Auth::attempt($cre)){
            return redirect('/');
        }
        else{
            return redirect('login')->with('thongbao','Login fail');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    // END LOGIN STATEMENT


    // REGISTER STATEMENT

    public function getRegister(){
        return view('page.register');
    }

    public function postRegister(Request $rq){
        $this->validate($rq,
            [
                'user_name' => 'required|max:30|min:3|unique:user,login',
                'user_pwd' => 'required|max:30|min:3|',
                'user_email' => 'required|email|unique:user,email',
                'user_fname' => 'required|max:30|min:3|',
                'user_lname' => 'required|max:30|min:3|'

            ],
            [
                'user_name.required' => 'Please type in user name',
                'user_name.unique' => 'This account has been used',
                'user_name.max' => 'User name not over than 30 characters',
                'user_name.min' => 'User name not less than 3 characters',
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
        $user = new user();
        $user->login = $rq->user_name;
        $user->password = Hash::make($rq->user_pwd);
        $user->email = $rq->user_email;
        $user->fname = $rq->user_fname;
        $user->lname = $rq->user_lname;
        $user->role = 3;
        $user->save();
        $rq->session()->flash('notification','Thanks for your subscribing !');
        return redirect('login')->with('thongbao','Add Successful');
//        echo $user->password;
    }
    // END LOGIN STATEMENT


    //ADMIN CONTROLLER
    public function getList(){
        $user = user::orderBy('id','ASC')->paginate(10);
        $role = user::select('role')->orderBy('role','ASC')->distinct()->get();
        return view('admin.user.list',['user'=>$user,'role'=>$role]);
    }
    public function getAddUser(){
        $user = user::all();
        return view('admin.user.add',['user'=>$user]);
    }

    public function postAddUser(Request $rq){
        $this->validate($rq,
            [
                'user_name' => 'required|max:30|min:3|unique:user,login',
                'user_pwd' => 'required|max:30|min:3|',
                'user_email' => 'required|email|unique:user,email',
                'user_fname' => 'required|max:30|min:3|',
                'user_lname' => 'required|max:30|min:3|'

            ],
            [
                'user_name.required' => 'Please type in user name',
                'user_name.unique' => 'This account has been used',
                'user_name.max' => 'User name not over than 30 characters',
                'user_name.min' => 'User name not less than 3 characters',
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
        $user = new user();
        $user->login = $rq->user_name;
        $user->password = Hash::make($rq->user_pwd);
        $user->email = $rq->user_email;
        $user->fname = $rq->user_fname;
        $user->lname = $rq->user_lname;
        $user->role = $rq->user_role;

        if($rq->hasFile('user_thumbnail')){
            $file = $rq->file('user_thumbnail');
            $file_extension = $file->getClientOriginalExtension();
            if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension !='jpeg'){
                return redirect('admin/user/add')->with('thongbao','Wrong file');
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4)."_".$name;
            while(file_exists("upload/avatar".$img))
            {
                $img = Str::random(4)."_".$name;
            }
            $file->move('upload/avatar',$img);
            $user->user_thumbnail = $img;
        }
        else{
            $user->user_thumbnail = "";
        }

        $user->save();

        return redirect('admin/user/add')->with('thongbao','Add Successful');
    }
    public function getupdateUser($id){
        $user = user::find($id);
        return view('admin.user.profile',['user'=>$user]);
    }

    public function postupdateUser(Request $rq,$id){
        $user = user::find($id);
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
                        return redirect('admin/user/edit/id='.$id)->with('thongbao','Wrong file');
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

                return redirect('admin/user/edit/id='.$id)->with('thongbao','Update Successful');
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
                return redirect('admin/user/edit/id='.$id)->with('thongbao','Update Successful');
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
                        return redirect('admin/user/edit/id='.$id)->with('thongbao','Wrong file');
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

                return redirect('admin/user/edit/id='.$id)->with('thongbao','Update Successful');
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

                return redirect('admin/user/edit/id='.$id)->with('thongbao','Update Successful');
            }
        }
    }

    // Return role user
    public function returnRole($id){
        $user = user::where('role',$id)->paginate(10);
        $role = user::select('role')->orderBy('role','ASC')->distinct()->get();
        return view('admin.user.list',['user'=>$user,'role'=>$role]);
    }

    function findUser(Request $rq){
        $tukhoa = $rq->keyword;
        $user = user::where('login','like','%'.$rq->keyword.'%')->paginate(10);
        $role = user::select('role')->orderBy('role','ASC')->distinct()->get();
        return view('admin.user.list',['user'=>$user,'tukhoa'=>$tukhoa,'role'=>$role]);
    }

    public function delete($id){
        $user = user::find($id);
        $user->delete();
        return redirect('admin/user/list')->with('thongbao','Delete Successful');
    }



    // END ADMIN CONTROLLER
}

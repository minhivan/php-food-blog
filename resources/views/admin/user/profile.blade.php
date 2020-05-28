@extends('admin.layout.index')

@section('content')
@if($user->login=='root')
    <div class="food-content">
        <div class="breadcrumb">
            <a href="admin/dashboard/dasboard">Spicy Food</a> / <a href="admin/user/list">User</a>
        </div>
        <h1>Please become root to edit this account "{{$user->login}}"</h1>
    </div>
@else
<div class="food-content">
    <div class="breadcrumb">
        <a href="admin/dashboard/dasboard">Spicy Food</a> / <a href="admin/user/list">User</a>
    </div>
    <h1>Profile >> {{$user->login}}</h1>
    <div class="wrap">
        <div class="post user-profile">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    @foreach($errors->all() as $err)
                        <p>{{$err}}</p>
                    @endforeach
                </div>
            @endif

            @if(session('thongbao'))
                <div class="alert alert-success">
                    <strong>{{session('thongbao')}}</strong>
                </div>
            @endif
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div>
                    <h4>Name</h4>
                    <fieldset>
                        <label for="user_name">Username</label>
                        <input type="text" name="user_name" id="username" placeholder="{{$user->login}}" value="{{$user->login}}" readonly>
                    </fieldset>
                    <fieldset>
                        <label for="user_fname">First Name</label>
                        <input type="text" name="user_fname" id="userfname" value="{{$user->fname}}" required>

                    </fieldset>
                    <fieldset>
                        <label for="user_lname">Last Name</label>
                        <input type="text" name="user_lname" id="userlname" value="{{$user->lname}}" required>
                    </fieldset>
                    <fieldset>
                        <label for="user_role">Role</label>
                        <select name="user_role" id="userrole">
                            @if(Auth::user()->role==2)
                                <option value="1" disabled>Administrator</option>
                                <option value="2">Editor</option>
                                <option value="3">Subscriber</option>
                            @else
                                <option value="1">Administrator</option>
                                <option value="2">Editor</option>
                                <option value="3">Subscriber</option>
                            @endif

                        </select>
                    </fieldset>
                </div>
                <div>
                    <h4>Contact Info</h4>
                    <fieldset>
                        <label for="user_email">Email(Required)</label>
                        <input type="text" name="user_email" id="useremail" value="{{$user->email}}" required>
                    </fieldset>
                    <fieldset>
                        <label for="user_fb_url">Facebook profile URL</label>
                        <input type="text" name="user_fb_url" id="userfburl">

                    </fieldset>
                </div>
                <div>
                    <h4>About Yourself</h4>
                    <fieldset>
                        <label for="user_bio">Biographical Info</label>
                        <input type="text" name="user_bio" id="userbio" placeholder="{{$user->bio}}">
                        <label for="user_img">Profile Picture</label>
                        @if($user->user_thumbnail=="")
                            <img src="source/content/img/avt/user.svg" alt="" name="user-img">
                        @else
                            <img src="./upload/avatar/{{$user->user_thumbnail}}" alt="" name="user-img">
                        @endif
                    </fieldset>
                    <fieldset>
                        <label for="user_thumbnail">Updating your avatar</label>
                        <input type="file" name="user_thumbnail">
                    </fieldset>
                </div>
                <div>
                    <h4>Account Management</h4>
                    <fieldset>
                        <label for="user_pwd">Password</label>
                        <input type="password" name="user_pwd" id="userpwd" value="{{$user->password}}" required>
                    </fieldset>
                    <fieldset>
                        <label for="retypepwd">Retype password</label>
                        <input type="password" name="retypepwd" id="retypepwd" placeholder="">
                    </fieldset>
                </div>
                <div class="post__submit">
                    <button type="submit">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif
@endsection

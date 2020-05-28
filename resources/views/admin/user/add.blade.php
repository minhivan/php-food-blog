@extends('admin.layout.index')

@section('content')
<div class="food-content media-wrapper">
    <div class="breadcrumb">
        <a href="admin/dashboard/dasboard">Spicy Food</a> / <a href="admin/user/list">User</a>
    </div>
    <h1>Add User</h1>
    <h5>Create a brand new user and add them to this site.</h5>
    <div class="wrap">
        <div class="post">
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
                <input type="text" name="user_name" id="user_name" placeholder="Username" required>
                <input type="password" name="user_pwd" id="user_pwd" placeholder="Password" required>
                <input type="text" name="user_email" id="user_email" placeholder="Email" required>
                <input type="text" name="user_fname" id="user_fname" placeholder="First Name" required>
                <input type="text" name="user_lname" id="user_lname" placeholder="Last Name">
                <input type="file" name="user_thumbnail">
                <select name="user_role" id="userrole">
                    <option value="1">Administrator</option>
                    <option value="2">Editor</option>
                    <option value="3" >Subscriber</option>
                </select>
                <div class="post__submit">
                    <button type="submit">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

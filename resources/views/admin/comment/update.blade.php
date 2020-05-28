@extends('admin.layout.index')
@section('content')
    <div class="food-content dashboard-wrapper">
        <div class="breadcrumb">
            <a href="">Spicy Food</a> / <a href="">Recipe</a> / <a href="admin/recipe/comment/list">Comment</a> / <span>Edit</span>
        </div>
        <h1>Edit comment</h1>
        <h4>Permalink: <a href="#">{{$data->recipe->title}}</a></h4>
        <div class="wrap">
            <div class="post-all">
                <div class="post categories">
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
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h4>Edit comment</h4>
                        <fieldset>
                            <label for="user_name">Name</label>
                            <input type="text" name="user_name" id="user_name" placeholder="{{$data->user->login}}" value="{{$data->user->login}}" readonly>
                        </fieldset>
                        <fieldset>
                            <label for="user_email">Email</label>
                            <input type="text" name="user_email" id="user_email" placeholder="{{$data->user->email}}" value="{{$data->user->email}}" readonly>
                        </fieldset>
                        <fieldset>
                            <label for="cmt_topic">Topic</label>
                            <select name="cmt_topic" id="cmtTopic">
                                <option value="0">Ask</option>
                                <option value="1">Review</option>
                                <option value="2">Edit</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <label for="cmt_content">Comment</label>
                            <textarea name="cmt_content" id="cmt_content" cols="30" rows="10" placeholder="{{$data->content}}"></textarea>
                        </fieldset>
                        <div class="post__submit">
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--  Side bar   -->
        </div>
    </div>
@endsection

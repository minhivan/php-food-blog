@extends('admin.layout.index')
@section('content')
<div class="food-content">
    <div class="breadcrumb">
        <a href="admin/">Spicy Food</a> / <a href="admin/recipe/comment/list">Comment</a>
    </div>
    <h1>All comment</h1>
    <div class="wrap">
        <div class="post-all">
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
            <ul class="sub-choice">
                <li class="all">
                    <a href="admin/recipe/comment/list" class="current">
                        All |
                    </a>
                </li>
                @foreach($role as $r)
                <li class="public">
                    @if($r->topic == 1)
                        <a href="admin/recipe/comment/list/topic=1" class="current">Review<span class="count"></span></a> |
                    @elseif($r->topic == 2)
                        <a href="admin/recipe/comment/list/topic=2" class="current">Edit<span class="count"></span></a> |
                    @else
                        <a href="admin/recipe/comment/list/topic=0" class="current">Ask<span class="count"></span></a> |
                    @endif
                </li>
                @endforeach
            </ul>
            <form action="admin/recipe/comment/find" method="get" id="post_filter">
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search Pages:</label>
                    <input type="search" id="post-search-input" name="keyword" value="">
                    <input type="submit" id="search-submit" class="button" value="Search Pages">
                </p>
                <div class="tablenav top">
                    <div class="pagination_links">
                        <ul class="pagination">
                            {{$data->links()}}
                        </ul>
                    </div>
                </div>
                <div class="table-view">
                    <div class="row-header">
                        <div class="col-select">
                            <input id="cb-select-all-1" type="checkbox">
                        </div>
                        <div class="col-author">
                            <span>Author</span>
                        </div>
                        <div class="col-comment">
                            <span>Comment</span>
                        </div>
                        <div class="col-topic">
                            <span>Topic</span>
                        </div>
                        <div class="col-respond-to">
                            <span>In Respond to</span>
                        </div>
                        <div class="col-date">
                            <span>Submited on</span>
                        </div>
                    </div>

                    @foreach($data as $i)
                    <div class="row-content">
                        <div class="col-select">
                            <input type="checkbox">
                        </div>
                        <div class="col-author">
                            <a href=""><img src="source/content/img/avt/user.svg" alt="">
                                <span>{{$i->user->login}}</span>
                            </a>
                        </div>
                        <div class="col-comment">
                            <span>"{{$i->content}}"</span>
                            <div class="row-content__action">
                                <a href="admin/recipe/comment/edit/id={{$i->id}}" class="color-red">Edit</a> | <a href="">Reply</a> | <a href="admin/recipe/comment/delete/id={{$i->id}}" class="color-red">Trash</a>
                            </div>
                        </div>
                        <div class="col-topic">
                            <span>
                                @if($i->topic == 1)
                                    Review
                                @elseif($i->topic == 2)
                                    Edit
                                @else
                                    Ask
                                @endif
                            </span>
                        </div>
                        <div class="col-respond-to">
                            <span><a href="#"></a></span>
                            <p> <a href="#">{{$i->recipe->title}}</a></p>
                        </div>
                        <div class="col-date">
                            <span>{{$i->updated_at}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="tablenav top">
                    <div class="pagination_links">
                        <ul class="pagination">
                            {{$data->links()}}
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <!--  Side bar   -->
    </div>
</div>
@endsection

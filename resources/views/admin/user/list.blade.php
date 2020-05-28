@extends('admin.layout.index')

@section('content')
<div class="food-content ">
    <div class="breadcrumb">
        <a href="./dashboard.html">Spicy Food</a> / <a href="admin/user/list">User</a>
    </div>
    <h1>All User</h1>
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
                    <a href="admin/user/list" class="current">
                        All
                        <span class="count"></span>
                        |
                    </a>
                </li>
                @foreach($role as $r)
                <li class="public">
                        @if($r->role==1)
                        <a href="admin/user/list/role=1" class="current">Administrator<span class="count"></span></a> |

                        @elseif($r->role==2)
                        <a href="admin/user/list/role=2" class="current">Editor<span class="count"></span></a> |
                        @else
                        <a href="admin/user/list/role=3" class="current">Subscriber<span class="count"></span></a> |
                        @endif
                </li>
                @endforeach
            </ul>
            <form action="admin/user/find" method="get" id="post_filter">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search User:</label>
                    <input type="search" id="post-search-input" name="keyword" value="">
                    <input type="submit" id="search-submit" class="button" value="Search">
                </p>
                <div class="tablenav top">
                    <div class="pagination_links">
                        <ul class="pagination">
                            {{$user->links()}}
                        </ul>
                    </div>
                </div>
                <div class="table-view">
                    <div class="row-header">
                        <div class="col-select">
                            <input id="cb-select-all-1" type="checkbox">
                        </div>
                        <div class="col-name">
                            <span>Username</span>
                        </div>
                        <div class="col-username">
                            <span>Name</span>
                        </div>
                        <div class="col-email">
                            <span>Email</span>
                        </div>
                        <div class="col-role">
                            <span>Role</span>
                        </div>
                        <div class="col-date">
                            <span>Join in</span>
                        </div>
                    </div>
                    @foreach($user as $i)
                    <div class="row-content">
                        <div class="col-select">
                            <input type="checkbox">
                        </div>
                        <div class="col-name">
                            <a href="">
                                @if($i->user_thumbnail=="")
                                    <img src="source/content/img/avt/user.svg" alt="" name="user-img">
                                @else
                                    <img src="./upload/avatar/{{$i->user_thumbnail}}" alt="" name="user-img">
                                @endif
                                <span>{{$i->login}}</span>
                            </a>
                            <div class="row-content__action">
                                <a href="admin/user/edit/id={{$i->id}}">Edit</a> | <a href="admin/user/delete/id={{$i->id}}" class="color-red">Delete</a> | <a href="admin/user/view">View</a>
                            </div>
                        </div>
                        <div class="col-username">
                            <span>
                                {{$i->lname}} {{$i->fname}}
                            </span>
                        </div>

                        <div class="col-email">
                            <span>{{$i->email}}</span>
                        </div>
                        <div class="col-role color-red">
                            <span>
                                @if($i->role==1)
                                    Administrator
                                @elseif($i->role==2)
                                    Editor
                                @else
                                    Subscriber
                                @endif</span>
                        </div>
                        <div class="col-date">
                            <span>{{$i->created_at}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="tablenav top">
                    <div class="pagination_links">
                        <ul class="pagination">
                            {{$user->links()}}
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <!--  Side bar   -->
    </div>
</div>
@endsection

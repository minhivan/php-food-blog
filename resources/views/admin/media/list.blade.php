@extends('admin.layout.index')
@section('content')
    <div class="food-content">
        <div class="breadcrumb">
            <a href="admin/">Spicy Food</a> / <a href="admin/media/list">Media</a>
        </div>
        <h1>Media Library</h1>
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
                <form action="" method="get" id="post_filter">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <p class="search-box">
                        <label class="screen-reader-text" for="post-search-input">Search image</label>
                        <input type="search" id="post-search-input" name="keyword" value="">
                        <input type="submit" id="search-submit" class="button" value="Search">
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
                            <div class="col-title">
                                <span>File</span>
                            </div>
                            <div class="col-author">
                                <span>Author</span>
                            </div>
                            <div class="col-uploaded">
                                <span>Uploaded to</span>
                            </div>
                            <div class="col-date">
                                <span>Date</span>
                            </div>
                        </div>

                        @foreach($data as $i)
                        <div class="row-content">
                            <div class="col-select">
                                <input  type="checkbox">
                            </div>
                            <div class="col-img">
                                    <span>
                                        <a href="{{$i->url}}">
                                            <img src="{{$i->url}}" alt="">
                                            <span>{{$i->slug}}</span>
                                        </a>
                                    </span>
                                <div class="row-content__action">
                                    <a href="admin/media/edit/id={{$i->id}}">Edit</a> | <a href="admin/media/delete/id={{$i->id}}" class="color-red">Delete</a>
                                </div>
                            </div>
                            <div class="col-author">
                                <span>{{$i->user->login}}</span>
                            </div>
                            <div class="col-uploaded">
                                <span>
                                    <a href="#">
{{--                                        {{$i->}}--}}
                                    </a>
                                </span>
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

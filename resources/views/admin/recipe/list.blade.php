@extends('admin.layout.index')
@section('content')
<div class="food-content">
    <div class="breadcrumb">
        <a href="admin/">Spicy Food</a> / <a href="admin/recipe/list">All recipe</a>
    </div>
    <h1>All Recipe</h1>
    <div class="wrap">
        <div class="post-all">
            <div class="filter-by">
                <form action="" method="get" id="recipe_fillter">
                    <label for="ingre_cat">Filter by Categories</label>
                    <select name="ingre_cat" id="ingre_cat">
                        @foreach($cat as $c)
                            <option value="admin/recipe/find/category/id={{$c->id}}">{{$c->title}}</option>
                        @endforeach
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>
            <ul class="sub-choice">
                <li class="all">
                    <a href="admin/recipe/list" class="current">
                        All
                        <span class="count">(11)</span>
                        |
                    </a>
                </li>
                @foreach($status as $t)
                <li class="public">
                    @if($t->status==1)
                    <a href="admin/recipe/list/status=1" class="current">Public | </a>
                    @elseif($t->status==0)
                        <a href="admin/recipe/list/status=0" class="current">Peding Review |</a>
                    @endif
                </li>
                @endforeach
            </ul>
            <form action="admin/recipe/find" method="get" id="post_filter">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search Recipe:</label>
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
                            <span>Name</span>
                        </div>
                        <div class="col-author">
                            <span>Author</span>
                        </div>
                        <div class="col-categories">
                            <span>Categories</span>
                        </div>
                        <div class="col-tags">
                            <span>Tags</span>
                        </div>
                        <div class="col-date">
                            <span>Date</span>
                        </div>
                    </div>
                    @foreach($data as $i)
                    <div class="row-content">
                        <div class="col-select">
                            <input id="" type="checkbox">
                        </div>
                        <div class="col-title">
                            <span><a href="page/recipe/{{$i->slug}}" target="_blank">{{$i->title}}</a></span>
                            <div class="row-content__action">
                                <a href="admin/recipe/edit/id={{$i->id}}">Edit</a> | <a href="admin/recipe/delete/id={{$i->id}}" class="color-red">Delete</a> | <a href="page/recipe/{{$i->slug}}">View</a>
                            </div>
                        </div>
                        <div class="col-author">
                            <span>root</span>
                        </div>
                        <div class="col-categories">
                            <span><a href="#">{{$i->category->title}}</a></span>
                        </div>
                        <div class="col-tags">
                            <span>
                                @foreach($i->tag as $m)
                                    <a href="admin/recipe/tag/edit/id={{$m->id}}">{{$m->title}}</a> |
                                @endforeach
{{--                                {{dd($i->tag)}}--}}
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

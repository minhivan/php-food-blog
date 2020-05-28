@extends('admin.layout.index')
@section('content')
    <div class="food-content">
        <div class="breadcrumb">
            <a href="/">Spicy Food</a> / <a href="">Group</a>
        </div>
        <h1>Recipe Group</h1>
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
                    <form action="" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h4>Add new group</h4>
                        <fieldset>
                            <label for="group_name">Name</label>
                            <input type="text" name="group_name" id="group_name" placeholder="Group Name" required>
                        </fieldset>
                        <fieldset>
                            <label for="image">Banner</label>
                            <div class="new-category input-field" id="banner">
                                <div id="drop-area">
                                    <input type="file" id="fileElem" name="image" accept="image/*" onchange="handleFiles(this.files)" required>
                                    <label class="button" for="fileElem">Background</label>
                                    <progress id="progress-bar" max=100 value=0></progress>
                                    <div id="gallery"></div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="post__submit">
                            <button type="submit">Add new</button>
                        </div>

                    </form>
                </div>
                <form action="admin/recipe/tag/find" method="get" id="post_filter">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <p class="search-box">
                        <label class="screen-reader-text" for="post-search-input">Search</label>
                        <input type="search" id="post-search-input" name="keyword" value="">
                        <input type="submit" id="search-submit" class="button" value="Search">
                    </p>
                    <div class="tablenav top">
                        <div class="pagination_links">
                            <ul class="pagination">
                                {{$group->links()}}
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
                            <div class="col-rcategories">
                                <span>Description</span>
                            </div>
                            <div class="col-used">
                                <span>Count</span>
                            </div>
                        </div>
                        @foreach($group as $i)
                            <div class="row-content">
                                <div class="col-select">
                                    <input id="{{$i->id}}" type="checkbox">
                                </div>
                                <div class="col-title">
                                    <span><a href="#">{{$i->title}}</a></span>
                                    <div class="row-content__action">
                                        <a href="admin/recipe/group/edit/id={{$i->id}}">Edit</a> | <a href="admin/recipe/group/delete/id={{$i->id}}" class="color-red">Delete</a> | <a href="page/tag/{{$i->slug}}">View</a>
                                    </div>
                                </div>
                                <div class="col-rcategories">
                            <span>
                                @if($i->description=='')
                                    -
                                @else
                                    {{$i->description}}
                                @endif
                            </span>
                                </div>
                                <div class="col-used">
{{--                                    <span>{{\App\recipe_tag::select('id_recipe')->where('id_tag','=',$i->id)->count()}}</span>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tablenav top">
                        <div class="pagination_links">
                            <ul class="pagination">
                                {{$group->links()}}
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <!--  Side bar   -->
        </div>
    </div>
@endsection

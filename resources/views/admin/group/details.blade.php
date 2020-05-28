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
                        <h4>Details</h4>
                        <fieldset>
                            <label for="group_name">Name</label>
                            <input type="text" name="group_name" id="group_name" value="{{$group->title}}" required>
                        </fieldset>
                        <fieldset>
                            <label for="image">Banner</label>
                            <div id="gallery1">
                                <img src="upload/image/{{$group->img_url}}"/>
                            </div>
                            <div class="new-category input-field" id="banner">
                                <div id="drop-area">
                                    <input type="file" id="fileElem" name="image" accept="image/*" onchange="handleFiles(this.files)" required>
                                    <label class="button" for="fileElem" style="width: 200px;text-align: center">Change Background</label>
                                    <progress id="progress-bar" max=100 value=0></progress>
                                    <div id="gallery"></div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="post__submit">
                            <button type="submit">UPDATE</button>
                            <button><a href="admin/recipe/group/details/id={{$group->id}}">DETAILS</a></button>
                        </div>

                    </form>
                </div>
                <form action="admin/recipe/group/edit/id={{$group->id}}" method="post" id="post_filter">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <p class="search-box">
                        <label class="screen-reader-text" for="post-search-input">Search</label>
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
                                <input id="cb-select-all-1" type="checkbox" >
                            </div>
                            <div class="col-title">
                                <span>Name</span>
                            </div>
                            <div class="col-rcategories">
                                <span>Author</span>
                            </div>
                            <div class="col-used">
                                <span>Group</span>
                            </div>
                        </div>
                        @foreach($data as $i)
                            <div class="row-content">
                                <div class="col-select">
                                </div>
                                <div class="col-title">
                                    <span><a href="#">{{$i->recipe->title}}</a></span>
                                    <div class="row-content__action">
                                        <a href="admin/recipe/group/delete/{{$i->recipe->id}}/{{$group->id}}" class="color-red">Remove</a> | <a href="page/recipe/{{$i->recipe->slug}}">View</a>
                                    </div>
                                </div>
                                <div class="col-rcategories">
                            <span>
                                {{$i->recipe->user->fname}} {{$i->recipe->user->lname}}
                            </span>
                                </div>
                                <div class="col-used">
                                    <a href="">{{$group->title}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tablenav top">
                        <button type="submit">Add to group</button>
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

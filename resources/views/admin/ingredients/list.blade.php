@extends('admin.layout.index')
@section('content')

<div class="food-content">
    <div class="breadcrumb">
        <a href="admin/">Spicy Food</a> / <a href="">Ingredients</a>
    </div>
    <h1>All Ingredients</h1>
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
                    <h4>Add new ingredient</h4>
                    <fieldset>
                        <label for="ingre_name">Name</label>
                        <input type="text" name="ingre_name" id="ingrname" placeholder="Ingredient Name" required>
                    </fieldset>
                    <fieldset>
                        <label for="ingre_description">Description</label>
                        <input type="text" name="ingre_description" id="ingdescript" placeholder="Description">
                    </fieldset>
                    <div class="post__submit">
                        <button type="submit">Add new</button>
                    </div>
                </form>
            </div>
            <form action="admin/recipe/ingredient/find" method="get" id="post_filter">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">Search ingredients</label>
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
                        <div class="col-rcategories">
                            <span>Description</span>
                        </div>
                        <div class="col-used">
                            <span>Recipe</span>
                        </div>
                    </div>
                    @foreach($data as $i)
                    <div class="row-content">
                        <div class="col-select">
                            <input id="" type="checkbox">
                        </div>
                        <div class="col-title">
                            <span><a href="#">{{$i->name}}</a></span>
                            <div class="row-content__action">
                                <a href="admin/recipe/ingredient/edit/id={{$i->id}}">Edit</a> | <a href="admin/recipe/ingredient/delete/id={{$i->id}}" class="color-red">Delete</a> | <a href="#">View</a>
                            </div>
                        </div>
                        <div class="col-rcategories">
                            <span>
                                @if($i->description=="")
                                    -
                                @else
                                    {{$i->description}}
                                @endif
                            </span>
                        </div>
                        <div class="col-used">
                            <span>-</span>
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

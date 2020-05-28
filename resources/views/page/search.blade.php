@extends('master')
@section('content')
<div class="main-heading search-top">
    <div class="search">
        <div class="container">
            <form action="page/search" method="get">
                <div class="search-block">
                    <div class="search-label">
                        <label for="search-field">I WANT TO MAKE
                        </label>
                    </div>
                    <div class="search-field">
                        <div class="search-field-input-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="search-field" placeholder="Search here or try our suggestions below" name="search">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Divide -->
<div class="divided"></div>
<!-- // End divide -->
<div class="category w3-animate-top">
    <div class="container">
        <h1 class="category-name">SHOWING : {{$data->count()}} RECIPE</h1>
    </div>
    <div class="list-recipe">
        <div class="container p-content">
            <div class="live-item clearfix">
                <div class="row item-row">
                    @foreach($data as $i)
                    <div class="col-md-3 col-xs-12 item-grids">
                        <div class="special-img">
                            @if($i->img_thumb != null)
                                @php
                                    $str = $i->img_thumb;
                                    $myArray = explode(';', $str);
                                    echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                @endphp
                            @endif
                            <div class="title-content">
                                <div class="details">
                                    <h2 class="title">
                                        <a href="page/recipe/{{$i->slug}}">{{$i->title}}</a>
                                    </h2>
                                    <div class="recipe-data">
                                        <div class="author">
                                            <span class="name">By <a href="#">{{\App\user::find($i->user_id)->login}}</a></span>
                                        </div>
                                        <div class="meta-data">
                                            <div class="cooking-time">
                                                <i class="fas fa-clock"></i><span> Done by: {{$i->cook_time}}
                                                    @php
                                                        if($i->cook_unit==1)
                                                            echo 'minutes';
                                                        elseif($i->cook_unit==2)
                                                            echo 'hour';
                                                        else
                                                            echo 'day';
                                                    @endphp</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="show-more">
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
@endsection

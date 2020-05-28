@extends('master')
@section('content')
    @include('slider')
<!-- Content -->
<div class="welcome" data-aos="fade-right">
    <div class="container">
        <div class="welcome-heading">
            <h1>Newest Recipes</h1>
            <div class="welcome-grid">
                <div class="container p-content">
                    @foreach($new as $i)
                    <div class="col-md-6 col-sm-12 p-double col-xs-12">
                        <div class="inner-title">
                            <div class="p-img-wrap">
                                <div class="inner-wrapper">
                                    <a href="#">
                                        @if($i->img_thumb != null)
                                            @php
                                                $str = $i->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                            @endphp
                                        @else
                                          <img src="upload/icon/picture.png" alt="" id="photo-hero" />
                                        @endif

                                    </a>
                                </div>
                            </div>
                            <div class="title-content">
                                <div class="details">
                                    <h2 class="title big-title">
                                        <a href="page/recipe/{{$i->slug}}">{{$i->title}}</a>
                                    </h2>
                                    <div class="recipe-data newest-rep">
                                        <div class="author">
                                            <span class="name">By <a href="page/profile/{{$i->user->login}}">{{$i->user->fname}} {{$i->user->lname}}</a></span>
                                        </div>
                                        <div class="meta-data">
                                            <div class="cooking-time">
                                                <span> Done by: {{$i->cook_time}}

                                                    @if($i->cook_unit==1)
                                                        minutes
                                                    @elseif($i->cook_unit==2)
                                                        hour
                                                    @else
                                                        day
                                                    @endif</span>
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
        </div>
    </div>

</div>
<!-- Special -->
<div class="special" data-aos="fade-left">
    <div class="container">
        <div class="special-heading">
            <h1>Quick & Easy</h1>
        </div>
        <div class="special-top-grids">
            <div class="row item-row">
                @foreach($pop as $i)
                <div class="col-md-3 item-grids">
                    <div class="special-img">
                        @if($i->img_thumb != null)
                            @php
                                $str = $i->img_thumb;
                                $myArray = explode(';', $str);
                                echo '<img src="upload/image/'.$myArray[0].'" alt="" />';
                            @endphp
                        @else
                            <img src="upload/icon/picture.png" alt=""  />
                        @endif
                        <div class="title-content saves__title">
                            <div class="title-author">
                                @php
                                    $user = \App\user::find($i->user_id);
                                    if($user->user_thumbnail != null){
                                        echo '<img src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                                    }
                                    else
                                        echo '<img src="upload/image/8vWG_pop.png" alt="">';
                                @endphp
                            </div>
                            <div class="details">
                                <h2 class="title">
                                    <a href="page/recipe/{{$i->slug}}">{{$i->title}}</a>
                                </h2>
                                <div class="recipe-data">
                                    <div class="author">
                                        <span class="name">By <a href="page/profile/{{$i->user->login}}">{{$i->user->fname}} {{$i->user->lname}}</a></span>
                                    </div>
                                    <div class="meta-data">
                                        <div class="cooking-time">
                                            <span> Done by: {{$i->cook_time}}

                                                @if($i->cook_unit==1)
                                                    minutes
                                                @elseif($i->cook_unit==2)
                                                    hour
                                                @else
                                                    day
                                                @endif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="show-more">
                <a href="/page/category/popular">VIEW ALL</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- // End Special -->

<!-- Trending -->
<div class="trending" data-aos="flip-left">
    <div class="container">
        <div class="special-heading">
            <h1>Trending Recipe</h1>
        </div>
        <div class="special-top-grids">
            <div class="row item-row">
                @foreach($trend as $t)
                <div class="col-md-3 item-grids">
                    <div class="special-img">
                        @if($t->img_thumb != null)
                            @php
                                $str = $t->img_thumb;
                                $myArray = explode(';', $str);
                                echo '<img src="upload/image/'.$myArray[0].'" alt="" />';
                            @endphp
                        @else
                            <img src="upload/icon/picture.png" alt=""  />
                        @endif
                        <div class="title-content saves__title">
                            <div class="title-author">
                                @php
                                    $user = \App\user::find($i->user_id);
                                     if($user->user_thumbnail != null){
                                         echo '<img src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                                     }
                                     else
                                         echo '<img src="upload/image/8vWG_pop.png" alt="">';
                                @endphp
                            </div>
                            <div class="details">
                                <h2 class="title">
                                    <a href="page/recipe/{{$t->slug}}">{{$t->title}}</a>
                                </h2>
                                <div class="recipe-data">
                                    <div class="author">
                                        <span class="name">By <a href="page/profile/{{$i->user->login}}">{{$i->user->fname}} {{$i->user->lname}}</a></span>
                                    </div>
                                    <div class="meta-data">
                                        <div class="cooking-time">
                                            <span> Done by: {{$i->cook_time}}

                                                    @if($i->cook_unit==1)
                                                        minutes
                                                    @elseif($i->cook_unit==2)
                                                        hour
                                                    @else
                                                        day
                                                    @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="show-more">
                <a href="/page/category/trending">VIEW ALL</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- // End trending -->
<!-- I wanna make -->
<div class="welcome index-creating" data-aos="zoom-in">
    <div class="container">
        <div class="welcome-heading">
            <h1>What we're creating</h1>
            <div class="welcome-grid">
                <div class="container p-content">
                    <div class="col-md-3 col-sm-12 p-double col-xs-12">
                        <div class="inner-title">
                            <div class="p-img-wrap">
                                <div class="inner-wrapper">
                                    <a href="#">
                                        @php
                                            $recipe = \App\recipe_tag::where('id_tag','=',8)->get()->random()->first();
                                            $str = \App\recipe::find($recipe->id_recipe)->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                        @endphp
                                    </a>
                                </div>
                            </div>
                            <div class="title-content">
                                <div class="details">
                                    <div class="tags">
                                        <span>Photos</span>
                                    </div>
                                    <h2 class="title big-title">
                                        <a href="">{{$tag->find(8)->title}}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 p-double col-xs-12">
                        <div class="inner-title">
                            <div class="p-img-wrap">
                                <div class="inner-wrapper">
                                    <a href="#">
                                        @php
                                            $recipe = \App\recipe_tag::where('id_tag','=',12)->orderBy('id','DESC')->get()->first();
                                            $str = \App\recipe::find($recipe->id_recipe)->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                        @endphp
                                    </a>
                                </div>
                            </div>
                            <div class="title-content">
                                <div class="details">
                                    <div class="tags">
                                        <span>Photos</span>
                                    </div>
                                    <h2 class="title big-title">
                                        <a href="#">{{$tag->find(12)->title}}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 p-double col-xs-12">
                        <div class="inner-title">
                            <div class="p-img-wrap">
                                <div class="inner-wrapper">
                                    <a href="#">
                                        @php
                                            $recipe = \App\recipe_tag::where('id_tag','=',9)->orderBy('id','DESC')->get()->first();
                                            $str = \App\recipe::find($recipe->id_recipe)->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                        @endphp
                                    </a>
                                </div>
                            </div>
                            <div class="title-content">
                                <div class="details">
                                    <div class="tags">
                                        <span>Photos</span>
                                    </div>
                                    <h2 class="title big-title">
                                        <a href="#">{{$tag->find(9)->title}}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('master')
@section('content')
    <div class="divided"></div>
    <div class="tag-divide">
        <div class="container">
            <div class="container__tag_recipe">
                <h2 class="error-page__headline tag-title">ALL RECIPE</h2>
{{--                <p class="error-page__description">{{$cat->description}}</p>--}}
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="welcome" data-aos="fade-right">
        <div class="container">
            <div class="welcome-heading">
                <div class="special-heading">
                    <h1>Newest Post</h1>
                </div>
                <div class="welcome-grid">
                    <div class="container p-content">
                        @foreach($new as $i)
                            <div class="col-md-6 col-sm-12 recipe-all">
                                <!--TAG RECIPE-->
                                <div class="smart-card-wrap">
                                    <div class="smart-content">
                                        <div class="smart-photo">
                                            <div class="smart-photo-inner">
                                                @if($i->img_thumb != null)
                                                    @php
                                                        $str = $i->img_thumb;
                                                        $myArray = explode(';', $str);
                                                        echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                                    @endphp
                                                @else
                                                    <img src="upload/icon/picture.png" alt="" id="photo-hero" />
                                                @endif
                                                <img src="" alt="">
                                            </div>
                                        </div>
                                        <div class="smart-info">
                                            <div class="smart-info-wrap">
                                                <label><a href="page/category/{{$i->category->slug}}">{{$i->category->title}}</a></label>
                                                <h2 class="title"><a href="page/recipe/{{$i->slug}}">{{$i->title}}</a></h2>
                                                <p class="description">"{{$i->description}}"</p>
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
    <div class="category">

        <div class="list-recipe">
            <div class="container p-content ">
                            <div class="custom-select">
                                <select name="" id="selectbox" onchange="javascript:location.href = this.value;">
                                    @foreach($cat as $i)
                                    <option value="page/category/{{$i->slug}}">{{$i->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                <div class="live-item clearfix">
                    <div class="row item-row">
                        @foreach($data as $i)
                            <div class="col-md-3 item-grids">
                                <div class="special-img">
                                    @if($i->img_thumb != null)
                                        @php
                                            $str = $i->img_thumb;
                                            $myArray = explode(';', $str);
                                            echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                        @endphp
                                    @endif
                                    <div class="title-content saves__title">
                                        <div class="title-author">
                                            @php
                                                $img = \App\user::where('id','=',$i->user_id)->get()->first();
                                                if($img->user_thumbnail != null){
                                                    echo '<img src="upload/image/'.$img->user_thumbnail.'" alt="">';
                                                }
                                                else
                                                    echo '<img src="upload/image/8vWG_pop.png" alt="">';
                                            @endphp
                                        </div>
                                        <div class="details">
                                            <p class="cat-title">
                                                <a href="page/category/{{$i->category->slug}}">{{$i->category->title}}</a>
                                            </p>
                                            <h2 class="title">
                                                <a href="page/recipe/{{$i->slug}}">{{$i->title}}</a>
                                            </h2>

                                            <div class="recipe-data">
                                                <div class="author">
                                                    <span class="name">By <a href="#">{{$i->user->login}}</a></span>
                                                </div>
                                                <div class="meta-data">
                                                    <div class="cooking-time">
                                                <span> Done by: {{$i->cook_time}}
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
                    <div class="show-more">
                        {{$data->links()}}
                    </div>
                </div>
            </div>

        </div>

@endsection

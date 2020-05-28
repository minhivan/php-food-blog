@extends('master')
@section('content')

<div class="divided"></div>
<div class="my-saves" data-aos="zoom-in">
    <div class="tabs">
        <ul class="tabs-main">
            <li class="tabs__tab tabs__active">
                <a href="page/save">SAVED DISHES</a>
            </li>
            <li class="tabs__tab">
                <a href="page/myboard">MY RECIPE</a>
            </li>
        </ul>
    </div>
    <section class="saves-section">
        <div class="saves container">
            <div class="saves__sort-by">
                <ul class="tabs-main">
                    <span>SORT BY: </span>
                    <li class="tabs__tab tabs__active">
                        <a href="page/save"> Newest</a>
                        <span> |</span>
                    </li>
                </ul>
            </div>
            <div class="saves__content container">
                <div class="live-item clearfix">
                    <div class="row item-row">
                        <div class="col-md-3 item-grids">
                            <div class="save_inner special-img">
                                <div class="save_inner__findmore">
                                    <img src="upload/icon/more.png" alt="" width="50px" height="50px">
                                    <span><a href="page/recipe">FIND MORE RECIPE</a></span>
                                </div>
                                <div class="save_inner__addnew title-content">
                                    <span>--- or ---</span>
                                    <a href="page/upload/recipe">Create your own recipe</a>
                                </div>
                            </div>
                        </div>
                        @foreach($data as $i)
                        <div class="col-md-3 item-grids">
                            <div class="special-img">
                                @if($i->recipe->img_thumb != null)
                                    @php
                                        $str = $i->recipe->img_thumb;
                                        $myArray = explode(';', $str);
                                        echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                    @endphp
                                @else
                                    <img src="upload/icon/picture.png" alt="" id="photo-hero" />
                                @endif
                                <div class="title-content saves__title">
                                    <div class="title-author">
                                        @php
                                            $img = \App\user::find($i->recipe->user_id);
                                            if($img->user_thumbnail != null){
                                                echo '<img src="upload/avatar/'.$img->user_thumbnail.'" alt="">';
                                            }
                                            else
                                                echo '<img src="upload/image/8vWG_pop.png" alt="">';
                                        @endphp
                                    </div>
                                    <div class="details">
                                        <h2 class="title">
                                            <a href="page/recipe/{{$i->recipe->slug}} ">{{$i->recipe->title}}</a>
                                        </h2>
                                        <div class="recipe-data">
                                            <div class="author">
                                                <span class="name">By <a href="page/profile/{{$i->user->login}}">{{\App\user::find($i->recipe->user_id)->fname}} {{\App\user::find($i->recipe->user_id)->lname}}</a></span>
                                            </div>
                                            <div class="meta-data">
                                                <div class="author">
                                                    <span class="name">
                                                        <i class="fas fa-trash"></i><a onclick="return confirm('Are you sure to remove it ?');" href="page/save/del/recipe/{{$i->recipe->slug}}"  style="color: red !important;">Remove</a>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>@endforeach
                    </div>
                    <div class="show-more">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

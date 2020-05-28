@extends('master')
@section('content')
<!-- // Banner -->
<div class="divided"></div>
<!-- // End divide -->
<!-- Recipe -->
<div class="recipe container ">
    <div class="breadcum row no-print">
        <div class="breadcum-holder">
            <a href="./recipe.html" class="recipe-breadcum-item">
                <i class="fas fa-backward"></i>
                <span class="recipe-breadcum__text">
                        Recipes
                    </span>
            </a>
            <span class="recipe-breadcum__text">/</span>
            <a href="page/category/{{$data->category->slug}}" class="recipe-breadcum-item">
                    <span class="recipe-breadcum__text">
                        {{$data->category->title}}
                    </span>
            </a>
        </div>
    </div>

    <!-- Title -->
    <div class="recipe-title">
        <h1>{{$data->title}}</h1>
    </div>
    <!-- End title -->
    <div class="recipe-container">
        <div class="recipe-left ">
            <!-- recipe details-->
            <div class="recipe-layout-details no-print">
                <div class="recipe-details__avatar ">
                    <a href="" class="user-avt">
                        @php
                            $user = $data->user;
                            if($user->user_thumbnail != null){
                                echo '<img class="user-avt__img" src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                            }
                            else
                                echo '<img class="user-avt__img" src="upload/image/8vWG_pop.png" alt="">';
                        @endphp

                    </a>
                </div>
                <div class="recipe-details-right ">
                    <div class="recipe-details__tag">
                        Collection:
                        @foreach($data->tag as $m)
                            <a href="page/tag/{{$m->slug}}">{{$m->title}}</a> |
                        @endforeach
                    </div>
                    <div class="recipe-details__author">
                        Recipe by <a href="#">{{$data->user->fname}} {{$data->user->lname}}</a>
                    </div>
                </div>

            </div>
            <!-- // End recipe details -->

            <!-- Recipe media -->
            <div class="recipe-layout-media">
                <div class="recipe-gallery">
                    <div class="recipe-main-img">
                        <div class="photo-hero">
                            @if($data->img_thumb!= null)
                                @php
                                    $str = $data->img_thumb;
                                    $myArray = explode(';', $str);
                                    echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                @endphp
                            @endif
                        </div>
                    </div>
                    <div class="photo-gallery no-print">
                        @if($data->img_thumb!= null)
                            @php
                                $str = $data->img_thumb;
                                $myArray = explode(';', $str);
                                foreach ($myArray as $img){
                                    echo '<div class="recipe-image"><img src="upload/image/'.$img.'" alt="" onclick="changeImg(this)" /></div>';
                                }
                            @endphp
                        @endif
                    </div>
                </div>
            </div>
            <!-- // End recipe media -->
            <!-- Recipe save -->
            <div class="recipe-layout-save no-print">
                <div class="recipe-save">
                    <div class="recipe-save__button">
                        <i class="fas fa-bookmark"></i>
                        <span>
                            @if(isset(\Illuminate\Support\Facades\Auth::user()->login))
                                    @if(!empty($isSave->id))
                                        <a href="page/save/">SAVED - VIEW YOUR SAVE RECIPE ?</a>
                                    @else
                                        <a href="page/recipe/save/id/{{$data->id}}">SAVE RECIPE</a>
                                    @endif
                            @else
                                    <a href="login">SAVE RECIPE</a>
                            @endif
                            </span>
                    </div>
                </div>
            </div>
            <!-- // End recipe save -->

            <!-- Recipe content left -->
            <div class="recipe-content__left recipe-layout__truncate col-md-6 col-sm-12">
                <div class="recipe-layout__fact">
                    <div class="recipe-facts">
                        <div class="recipe-facts__info">
                            <div class="recipe-facts__details recipe-facts__servings"><span
                                    class="recipe-facts__title">SERVE FOR :</span> {{$data->serve_for}} PEOPLE</div>
                        </div>
                        <div class="recipe-facts__info">
                            <!---->
                            <div class="recipe-facts__details recipe-facts__units">
                                <span class="recipe-facts__title">COOK :</span> {{$data->cook_time}}
                                    @php
                                        if($data->cook_unit==1)
                                            echo 'MINUTES';
                                        elseif($data->prepare_unit==2)
                                            echo 'HOUR';
                                        else
                                            echo 'DAY';
                                    @endphp

                            </div>

                        </div>
                        <!---->
                    </div>
                </div>

                <div class="recipe-layout__ingredient">
                    <div class="recipe-ingredients">
                        <div class="recipe-ingredients__heading">
                            <h4 class="recipe-ingredients__title">INGREDIENTS</h4>
                        </div>
                        <ul class="recipe-ingredients__steps">
                            <li class="recipe-ingredients__step">
                                @php
                                    echo nl2br($data->ingredients);
                                @endphp
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- // End recipe content left -->

            <!-- Direction -->
            <div class="recipe-content__right recipe-layout__truncate col-md-6 col-sm-12">
                <h4 class="recipe-directions__title">DIRECTION</h4>
                <ul class="recipe-directions__steps">
                    <li class="recipe-directions__step">
                        @php
                            echo nl2br($data->step);
                        @endphp
                    </li>

                </ul>
            </div>
            <!---->
            <!-- // End direction -->

            <!-- CONTROLS -->
            <div class="recipe-layout__controls">
                <div class="recipe-layout__print-btn">
                    <div class="recipe-print">
                        <a onclick="showMore();window.print()">
                            <i class="fas fa-print"></i>
                            PRINT RECIPE
                        </a>
                    </div>
                </div>
                <div class="recipe-layout__show-btn no-print">
                    <div class="showmore-btn"> <a id="showmore-btn" onclick="showMore()">
                            <i class="fas fa-caret-down"></i>
                            SEE FULL RECIPE
                        </a>
                    </div>

                </div>
            </div>
            <!-- // End Controls -->


            <!-- Conservation -->
            <div class="recipe-layout__conservation no-print">
                <div class="conservation">
                    <div class="conservation-title">
                        <h3>LEAVE A COMMENT</h3>
                    </div>
                    <div class="conservation-action">
                        <div class="activity-action activity-action--upload" onclick="changeAction(1)">
                            <i class="fas fa-camera"></i>
                            <div class="activity-title" >UPLOAD</div>
                        </div>
                        <div class="activity-action activity-action--review" onclick="changeAction(2)">
                            <i class="fas fa-star"></i>
                            <div class="activity-title">REVIEW</div>
                        </div>
                        <div class="activity-action activity-action--ask" onclick="changeAction(3)">
                            <i class="fas fa-question"></i>
                            <div class="activity-title">ASK</div>
                        </div>
                    </div>
                    @if(isset(\Illuminate\Support\Facades\Auth::user()->login))
                        <form action="page/comment/{{$data->slug}}" id="check-form" class="hidden"></form>
                        <form action="" id="review-form" method="post" class="review-form active" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="post">
                            <div class="post__avt">
                                <a href="#" class="user-avt round-avt">
                                    @php
                                        $user = $data->user;
                                        if($user->user_thumbnail != null){
                                            echo '<img class="user-avt__img" src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                                        }
                                        else
                                            echo '<img class="user-avt__img" src="upload/image/8vWG_pop.png" alt="">';
                                    @endphp
                                </a>
                            </div>
                            <div class="post__header">
                                <div class="post__meta">
                                    <div class="post__author" >
                                        <span id="post_action">REVIEW</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post__text">
                            <textarea placeholder="Start typing..." id="input_comment" name="comment"></textarea>
                        </div>
                        <div class="upload_image">
                            <div id="drop-area">
                                <input type="file" name="image" id="fileElem" accept="image/*" onchange="handleFiles(this.files)">
                                <label class="button" for="fileElem">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <progress id="progress-bar" max=100 value=0></progress>
                                <div id="gallery"></div>
                            </div>
                        </div>
                        <button type="submit">POST</button>
                    </form>
                    @endif
                    <div class="conservation__controls">
                        <div class="conservation__filters">
                            <div class="conservation__filter conservation__filter--all conservartion__filter-active">ALL</div>
                            <div class="conservation__filter conservation__filter--review">REVIEW</div>
                            <div class="conservation__filter conservation__filter--ask">QUESTION</div>
                        </div>
                    </div>
                    <div class="conservation__posts">
                        <ol class="conservation__posts-list">
                            @if($cmt->count()==0)
                                <li class="conservation__post">
                                    <div class="post">
                                        <div class="post__text">
                                            <div class="post__text-truncate">
                                                <h2>Be the first to comment on this recipe</h2>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                            @foreach($cmt as $i)
                            <li class="conservation__post">
                                <div class="post">
                                    <div class="post__avt">
                                        <a href="#" class="user-avt round-avt">
                                            @php
                                                $user = $i->user;
                                                if($user->user_thumbnail != null){
                                                    echo '<img class="user-avt__img" src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                                                }
                                                else
                                                    echo '<img class="user-avt__img" src="upload/image/8vWG_pop.png" alt="">';
                                            @endphp
                                        </a>
                                    </div>
                                    <div class="post__header">
                                        <div class="post__meta">
                                            <div class="post__author">
                                                @if($i->topic==1)
                                                    Photo by
                                                @elseif($i->topic==2)
                                                    Review by
                                                @else
                                                    Ask by
                                                @endif
                                                <a href="page/profile/{{$i->user->login}}" class="post__author-link"> {{\App\user::where('id','=',$i->user_id)->get()->first()->fname}} {{\App\user::where('id','=',$i->user_id)->get()->first()->lname}}</a>
                                            </div>
                                            <div class="post__date">
                                                <span>{{$i->created_at}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post__text">
                                        <div class="post__text-truncate">
                                            <span>" {{$i->content}} "</span>
                                        </div>
                                    </div>
                                    <div class="post__img">
                                        <div class="post__img-truncate">
                                            <img src="upload/image/{{$i->img_url}}" alt="">
                                        </div>
                                    </div>

                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ol>
                        <div class="conservation__show-more">
                            {{$cmt->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Advertise -->
        <div class="recipe-right adv no-print"></div>
    </div>

    <!-- // End -->
</div>
<script type="text/javascript">
    let formID = document.getElementById('review-form');
    formID.style.display="none";
</script>
<script src="source/assets/js/uploadImage.js"></script>

<!-- //End repice -->
@endsection


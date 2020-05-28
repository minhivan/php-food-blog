@extends('master')
@section('content')

    <!-- Page -->
    <div class="category">
        <div class="tag-divide">
            <div class="container">
                <div class="container__tag_recipe">
                    <h2 class="error-page__headline tag-title">{{$group->title}}</h2>
                </div>
            </div>
        </div>
        <div class="list-recipe">
            <div class="container p-content ">
                <div class="live-item clearfix">
                    <div class="row item-row">
                        @if($data->isEmpty())
                            <div class="container">
                                <h1 class="category-name">SORRY, WE COULDN'T FIND ANYTHING</h1>
                            </div>
                        @else
                            @foreach($data as $i)
                                <div class="col-md-8 col-sm-12">
                                    <!--TAG RECIPE-->
                                    <div class="smart-card-wrap">
                                        <div class="smart-content">
                                            <div class="smart-photo">
                                                <div class="smart-photo-inner">
                                                    @if(\App\recipe::find($i->id_recipe)->img_thumb != null)
                                                        @php
                                                            $str = \App\recipe::find($i->id_recipe)->img_thumb;
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
                                                    <label>recipe</label>
                                                    <h2 class="title"><a href="page/recipe/{{\App\recipe::find($i->id_recipe)->slug}}">{{\App\recipe::find($i->id_recipe)->title}}</a></h2>
                                                    <p class="description">"{{\App\recipe::find($i->id_recipe)->description}}"</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-4 col-sm-12"></div>
                    </div>
                </div>
                <div class="show-more">
                    {{$data->links()}}
                </div>
            </div>
        </div>

    </div>

    <!-- // End page -->
@endsection

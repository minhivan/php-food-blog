@extends('master')
@section('content')

    <div class="divided"></div>
    @if(count($errors) > 0)
        <div class="alert alert-danger container">
            <strong>Error!</strong>
            @foreach($errors->all() as $err)
                <p>{{$err}}</p>
            @endforeach
        </div>
    @endif

    @if(session('thongbao'))
        <div class="alert alert-success container">
            <strong>{{session('thongbao')}}</strong>
        </div>
    @endif
    <div class="my-saves" data-aos="zoom-in">
        <div class="tabs">
            <ul class="tabs-main">
                <li class="tabs__tab ">
                    <a href="page/save">SAVED DISHES</a>
                </li>
                <li class="tabs__tab tabs__active">
                    <a href="page/myboard/">MY RECIPE</a>
                </li>
            </ul>
        </div>
        <section class="saves-section">
            <div class="saves container">
                <div class="saves__sort-by">
                    <ul class="tabs-main">
                        <span>SORT BY: </span>
                        <li class="tabs__tab tabs__active">
                            <a href="page/myboard/"> Newest</a>
                            <span> |</span>
                        </li>
                        <li class="tabs__tab">
                            <a href="page/myboard/filter=a-z">A-Z </a>
                            <span> | </span>
                        </li>
                        <li class="tabs__tab">
                            <a href="page/myboard/filter=review">Pending Review</a>
                            <span> | </span>
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
                                        <span><a href="page/upload/recipe">CREATE MORE RECIPE</a></span>
                                    </div>
                                    <div class="save_inner__addnew title-content">
                                    </div>
                                </div>
                            </div>
                            @foreach($data as $i)
                                <div class="col-md-3 item-grids">
                                    <div class="special-img">
                                        @if($i->img_thumb != null)
                                            @php
                                                $str = $i->img_thumb;
                                                $myArray = explode(';', $str);
                                                echo '<img src="upload/image/'.$myArray[0].'" alt="" id="photo-hero" />';
                                            @endphp
                                        @else
                                            <img src="upload/icon/picture.png" alt="" id="photo-hero" />
                                        @endif
                                        <div class="title-content saves__title">
                                            <div class="title-author">
                                                @php
                                                    $img = \App\user::find($i->user_id);
                                                    if($img->user_thumbnail != null){
                                                        echo '<img src="upload/avatar/'.$img->user_thumbnail.'" alt="">';
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
                                                    <div class="meta-data">
                                                        <span class="name">
                                                            @if($i->status==1)
                                                                Uploaded at <b>{{$i->created_at}}</b>
                                                            @else
                                                                Status: Pending Review
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="author">
                                                        <span class="name">
                                                            <i class="fas fa-edit"></i><a href="page/edit/recipe/{{$i->slug}}" >Edit</a> |
                                                            <i class="fas fa-trash"></i><a onclick="return confirm('Are you sure to delete it ?');" href="page/myboard/del/recipe/{{$i->slug}}" style="color: red!important;">Delete</a> |
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>@endforeach
                        </div>
                    </div>
                    <div class="show-more">
                        {{$data->links()}}
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection
<script>
    var deleteLinks = document.querySelectorAll('.delete');

    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            var choice = confirm(this.getAttribute('data-confirm'));

            if (choice) {
                window.location.href = this.getAttribute('href');
            }
        });
    }
</script>

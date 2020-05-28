@extends('admin.layout.index')
@section('content')
    <div class="food-content media-wrapper">
        <div class="breadcrumb">
            <a href="admin">Spicy Food</a> / <a href="admin/media/list">Media</a> / <span>Edit media</span>
        </div>
        <h1>Edit Media</h1>
        <div class="wrap">
            <div class="post">
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
                    <input type="text" name="post__title" id="post-title" placeholder="{{$data->slug}}" readonly>
                    <img src="{{$data->url}}" alt="">
                    <div class="new-category input-field">

                        <div id="drop-area">
                            <input type="file" id="fileElem" name="image" accept="image/*" onchange="handleFiles(this.files)" required>
                            <label class="button" for="fileElem">Update New File</label>
                            <progress id="progress-bar" max=100 value=0></progress>
                            <div id="gallery"></div>
                        </div>
                    </div>
                    <div class="post__submit">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>
            <!--  Side bar   -->
        </div>
    </div>
@endsection

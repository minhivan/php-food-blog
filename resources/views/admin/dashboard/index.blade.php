@extends('admin.layout.index')

@section('content')
    <div class="food-content dashboard-wrapper">
        <div class="breadcrumb">
            <a href="admin/">Dashboard</a>
        </div>
        <h1>Dashboard</h1>
        <div class="wrap">
            <div class="dashboard-wrap">
                <div class="postbox-container" id="postbox-1">
                    <div class="inside">
                        <div id="activity-widget">
                            <div id="published-posts" class="activity-block">
                                <h3>Recently Published</h3>
                                <ul>
                                    @foreach($data as $i)
                                    <li>
                                        <span>{{$i->updated_at}}</span>
                                        <a href="#">{{$i->title}}</a> - by {{$i->user->login}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox-container" id="postbox-2">
                    <div class="inside">
                        <div id="activity-widget-2">
                            <div id="published-posts-2" class="activity-block">
                                <h3>Recently comment</h3>
                                <ul>
                                    @foreach($cmt as $i)
                                    <li>
                                        Content:
                                        <a href="#">"{{$i->content}}"</a>
                                        <span>| by : <a href="#">{{$i->user->login}}</a></span>
                                        <span>| on <a href="admin/recipe/edit/id={{$i->recipe->id}}">{{$i->recipe->title}}</a> -</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="postbox-container" id="postbox-3">
                    <div class="inside">
                        <div id="activity-widget-3">
                            <div id="published-posts-3" class="activity-block">
                                <h3>Recently Published</h3>
                                <ul>
                                    <li>
                                        <span>Dec 31st 2019, 4:51 am</span>
                                        <a href="#" aria-label="Edit “Chào tất cả mọi người!”">Chào tất cả mọi người!</a>
                                    </li>
                                    <li>
                                        <span>Nov 19th 2015, 10:26 am</span>
                                        <a href="#" aria-label="Edit “Welcome to Flatsome”">Welcome to Flatsome</a>
                                    </li>
                                    <li>
                                        <span>Oct 13th 2015, 9:13 pm</span>
                                        <a href="#" aria-label="Edit “Just another post with A Gallery”">Just another post with A Gallery</a>
                                    </li>
                                    <li>
                                        <span>Oct 13th 2015, 7:28 pm</span> <a href="#" aria-label="Edit “A Simple Blog Post”">A Simple Blog Post</a>
                                    </li>
                                    <li><span>Jan 1st 2014, 4:47 pm</span>
                                        <a href="#" aria-label="Edit “A Video Blog Post”">A Video Blog Post</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

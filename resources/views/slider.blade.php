<div class="banner">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($groupBanner as $i)
            <div class="item" id="item1" style="background-image: url('upload/image/{{$i->img_url}}')">
                <div class="carousel-caption">
                    <h2 class="title">
                        <a href="page/idea/{{$i->slug}}">{{$i->title}}</a>
                    </h2>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script type="text/javascript">
    $(".carousel-inner > .item:first").addClass("active");
</script>

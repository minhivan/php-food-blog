
<!-- Header-list  -->
<div class="header no-print">
    <div class="header-grid">
        <!-- Group link and brand for mobile -->
        <div class="navbar-top col-xs-12">
            <div class="navbar-header">

                <!-- Brand and name -->
                <div class="navbar-brand logo ">
                    <h1>
                        <a href="/">Spicy <span>Food</span></a>
                    </h1>
                </div>
                <!-- // End brand and name -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect link form and other content -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/">HOME</a>
                    </li>
                    <li>
                        <a href="page/recipe">RECIPE</a>
                    </li>
                    <li class="dropdown" id="hid-mobile">
                        <a href="#" class="dropdown-toggle" aria-expanded="true" data-toggle="dropdown">MORE<b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="page/category/popular">POPULAR</a>
                            </li>
                            <li>
                                <a href="page/category/recommend">RECOMMENDED</a>
                            </li>
                            <li>
                                <a href="page/category/trending">TRENDING</a>
                            </li>
                            <li>
                                <a href="page/category/quick-easy">QUICK & EASY</a>
                            </li>
                            <li>
                                <a href="page/category/healthy">HEALTHY</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="page/collection">COLLECTIONS</a>
                    </li>
                    <li>
                        @if(isset(Auth::user()->id))
                        <a href="page/save/">SAVES</a>
                        @endif
                    </li>
                </ul>
            </div>
            <!-- // End Collect link-->
        </div>
        <!-- // End group -->
        <div class="header-left">
            <ul class="left-menu-user">
                <li>
                    <i class="fas fa-search"></i>
                    <a href="page/search">SEARCH</a></li>
                <li>
                    @if(isset(Auth::user()->login))
                    <a href="#" class="dropdown-toggle" aria-expanded="true" data-toggle="dropdown">
                        @php
                            $user = Auth::user();
                            if($user->user_thumbnail != null){
                                echo '<img src="upload/avatar/'.$user->user_thumbnail.'" alt="">';
                            }
                            else
                                echo '<img src="upload/image/8vWG_pop.png" alt="">';
                        @endphp
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="page/profile/{{Auth::user()->login}}">Profile</a>
                        </li>
                        @if(Auth::user()->role==2 || Auth::user()->role==1)
                        <li id="hidd">
                            <a href="/admin">Admin</a>
                        </li>
                        @endif
                        <li>
                            <a href="page/upload/recipe">Add recipe</a>
                        </li>
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                    @else
                        <i class="fas fa-user"></i><a href="login">SIGN IN</a>
                    @endif
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

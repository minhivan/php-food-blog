<div class="header-menu">

    <div class="header-menu__home">
        <a href="/">
            <i class="icon icon-home"></i>
            Spicy Food
        </a>
    </div>
    <div class="header-menu__notice">
        <a href="#">
            <i class="icon icon-notice"></i>
            0
        </a>
    </div>
    <div class="header_menu__addnew">
        <a href="./new-post.html">
            <i class="icon icon-addnew"></i>
            New
        </a>
    </div>
    @if(isset(Auth::user()->login))
    <div class="header_menu__user">
        <a href="admin/user/edit/id={{Auth::user()->id}}">
            <i class="icon icon-user"></i>
            Hello {{Auth::user()->login}}
        </a>
    </div>
    @endif
    <div class="header_menu__user">
        <a href="logout">
            <i class="icon icon-user"></i>
            Logout
        </a>
    </div>
</div>

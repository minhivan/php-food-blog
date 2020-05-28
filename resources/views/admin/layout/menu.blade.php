<div class="food-left-menu">
    <ul id="admin_menu">
        <li class="food-first-item food-menu-item">
            <a href="admin/">
                <i class="icon icon-dashboard"></i>
                <span class="menu-name">Dashboard</span>
            </a>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="admin/">
                <i class="icon icon-post"></i>
                <span class="menu-name">Recipe</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="admin/recipe/list">All recipe</a>
                </li>
                <li>
                    <a href="admin/recipe/add">Add new</a>
                </li>
                <li>
                    <a href="admin/recipe/category/list">Categories</a>
                </li>
                <li>
                    <a href="admin/recipe/tag/list">Tags</a>
                </li>
            </ul>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="admin/recipe/group/list">
                <i class="icon icon-photo"></i>
                <span class="menu-name">Group</span>
            </a>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="admin/media/list">
                <i class="icon icon-photo"></i>
                <span class="menu-name">Media</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="admin/media/list">Libary</a>
                </li>
                <li>
                    <a href="admin/media/upload">Add new</a>
                </li>
            </ul>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="admin/recipe/comment/list">
                <i class="icon icon-notice"></i>
                <span class="menu-name">Comments</span>
            </a>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="admin/user/list">
                <i class="icon icon-user"></i>
                <span class="menu-name">User</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="admin/user/list">All User</a>
                </li>
                <li>
                    <a href="admin/user/add">Add new</a>
                </li>
                <li>
                    <a href="admin/user/edit/id={{Auth::user()->id}}">Your Profile</a>
                </li>
            </ul>
        </li>
        <li class="food-menu-item has-sub-menu">
            <a href="#">
                <i class="icon icon-setting"></i>
                <span class="menu-name">Setting</span>
            </a>
        </li>
    </ul>
</div>

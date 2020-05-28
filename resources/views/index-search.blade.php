<div class="search no-print">
    <div class="container">
        <form action="page/search" method="get">
            <div class="search-block">
                <div class="search-label">
                    <label for="search-field">I WANT TO MAKE
                    </label>
                </div>
                <div class="search-field">
                    <div class="search-field-input-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-field" placeholder="Search here or try our suggestions below" name="search">
                    </div>
                </div>
            </div>
            <ul class="search-tag">
                @foreach($tagRand as $i)
                    <li><a href="page/tag/{{$i->slug}}">{{$i->title}}</a></li>
                @endforeach

            </ul>
        </form>
    </div>
</div>
<!-- // End search -->

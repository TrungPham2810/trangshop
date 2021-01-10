<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('home')}}" class="active">Home</a></li>
        @foreach($categoriesLimit as $category)
        <li class="dropdown">
            <a href="{{getCategoryUrl($category)}}">{{$category->name}}<i class="fa fa-angle-down"></i></a>
            @if($category->categoryChildren()->count() > 0)
                <ul role="menu" class="sub-menu">
                    @foreach($category->categoryChildren as $child)
                    <li><a href="{{getCategoryUrl($child)}}">{{$child->name}}</a></li>
                    @endforeach
                </ul>
            @endif

        </li>
        @endforeach
        <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="blog.html">Blog List</a></li>
                <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
        </li>
        <li><a href="404.html">404</a></li>
        <li><a href="contact-us.html">Contact</a></li>
    </ul>
</div>
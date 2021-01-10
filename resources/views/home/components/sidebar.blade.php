<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $category)
                @if($category->categoryChildren->count() > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#{{strtolower($category->slug)}}" href="{{getCategoryUrl($category)}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$category->name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{strtolower($category->slug)}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categoryChildren as $categoryChildren)
                                <li><a href="{{getCategoryUrl($categoryChildren)}}">{{$categoryChildren->name}} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="{{getCategoryUrl($categoryChildren)}}">{{$category->name}}</a></h4>
                        </div>
                    </div>
                @endif
            @endforeach

        </div><!--/category-products-->
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->

    </div>
</div>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <div class="catalog-ordering">
                    <ul class="orderby order-dropdown col-md-4">
                        <li>
                            <span class="current-li">
                                <span class="current-li-content">
                                    <a aria-haspopup="true">Sort by <strong>...</strong></a>
                                </span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </span>
                            <ul>
@if(Route::currentRouteName() == 'main')
                                <li><a href="{{route('main')}}/?sort=priceHF&search={{request()->get('search')}}">Sort by <strong>Price: Highest first</strong></a></li>
                                <li><a href="{{route('main')}}/?sort=priceLF&search={{request()->get('search')}}">Sort by <strong>Price: Lowest first</strong></a></li>
                                <li><a href="{{route('main')}}/?sort=nameAZ&search={{request()->get('search')}}">Sort by <strong>Name: A-Z</strong></a></li>
                                <li><a href="{{route('main')}}/?sort=nameZA&search={{request()->get('search')}}">Sort by <strong>Name: Z-A</strong></a></li>
@endif
@if(Route::currentRouteName() == 'category')
    <li><a href="{{route('category',['category'=> Route::input('category')])}}/?sort=priceHF&search={{request()->get('search')}}">Sort by <strong>Price: Highest first</strong></a></li>
    <li><a href="{{route('category',['category'=> Route::input('category')])}}/?sort=priceLF&search={{request()->get('search')}}">Sort by <strong>Price: Lowest first</strong></a></li>
    <li><a href="{{route('category',['category'=> Route::input('category')])}}/?sort=nameAZ&search={{request()->get('search')}}">Sort by <strong>Name: A-Z</strong></a></li>
    <li><a href="{{route('category',['category'=> Route::input('category')])}}/?sort=nameZA&search={{request()->get('search')}}">Sort by <strong>Name: Z-A</strong></a></li>
@endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 text-right">
                <form id="search-cat2" class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" name="search2" class="form-control" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

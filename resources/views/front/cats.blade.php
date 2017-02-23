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
                                <li><a href="{{route('main')}}/?cat={{$catId}}&sort=priceHF">Sort by <strong>Price: Highest first</strong></a></li>
                                <li><a href="{{route('main')}}/?cat={{$catId}}&sort=priceLF">Sort by <strong>Price: Lowest first</strong></a></li>
                                <li><a href="{{route('main')}}/?cat={{$catId}}&sort=nameAZ">Sort by <strong>Name: A-Z</strong></a></li>
                                <li><a href="{{route('main')}}/?cat={{$catId}}&sort=nameZA">Sort by <strong>Name: Z-A</strong></a></li>
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
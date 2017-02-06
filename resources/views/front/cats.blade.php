<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <div class="catalog-ordering">
                    <ul class="orderby order-dropdown">
                        <li>
                            <span class="current-li">
                                <span class="current-li-content">
                                    <a aria-haspopup="true">Sort by <strong>Category</strong></a>
                                </span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </span>
                            <ul>
                                @foreach($categories as $key => $value)
                                    <li><a href="{{route('main')}}/?cat={{$key}}">Sort by <strong>{{$value}}</strong></a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 text-right">
                <form id="search-cat" class="form-inline" method="GET">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
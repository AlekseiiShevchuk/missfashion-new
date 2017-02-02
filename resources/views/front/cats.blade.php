<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <div class="catalog-ordering">
                    <ul class="orderby order-dropdown">
                        <li>
                            <span class="current-li">
                                <span class="current-li-content">
                                    <a aria-haspopup="true">Select a category</a>
                                </span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </span>
                            <ul>
                                @foreach($categories as $key => $value)
                                    <li><a href="{{route('main')}}?cat={{$key}}">{{$value}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <!--<div class="orderby-order-container">-->
                    <ul class="orderby order-dropdown">
                        <li>
                                <span class="current-li">
                                    <span class="current-li-content">
                                        <a aria-haspopup="true">Sort by <strong>Default Order</strong></a>
                                    </span>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </span>
                            <ul>
                                <li class="current">
                                    <a href="#">Sort by <strong>Default Order</strong></a>
                                </li>
                                <li>
                                    <a href="#">Sort by <strong>Name</strong></a>
                                </li>
                                <li>
                                    <a href="#">Sort by <strong>Price</strong></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!--</div>-->
                    <ul class="orderby order-dropdown">
                        <li>
                            <span class="current-li">
                                <span class="current-li-content">
                                    <a aria-haspopup="true">Show <strong>16 Products</strong></a>
                                </span>
                                 <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </span>
                            <ul>
                                <li class="current">
                                    <a href="#">Show <strong>16 Products</strong></a>
                                </li>
                                <li>
                                    <a href="#">Show <strong>32 Products</strong></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 text-right">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
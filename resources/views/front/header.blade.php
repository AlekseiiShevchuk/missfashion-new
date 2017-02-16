<header>
<div class="header__top">
    <div class="container">
        <div class="row">
        <div class="social-icons col-md-6 pull-left">
            <a href="" class="social-icons__link">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="" class="social-icons__link">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="" class="social-icons__link">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-md-3 pull-right">
            <form id="search-cat" class="form" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Search">
            </form>
        </div>
        </div>
    </div>
</div>

<nav class="navbar main-navbar" role="navigation" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="{{ URL::asset('/front/images/missfashion-logo.png') }}" alt="Missfashion Logo" width="200px;"></a>
            </div>
            <div class="collapse navbar-collapse" id="collapse-1">
                @if($categories)
                <ul class="nav navbar-nav navbar-right">
                    <li class="mega-submenu-wrap">
                        <a href="#" >Categories <span class="caret"></span></a>
                        <div class="mega-submenu">
                            <div class="mega-submenu-holder">
                                <div class="mega-submenu-content">
                                    @foreach($categories as $category)
                                        <div class="mega-submenu-content__item">
                                            <div class="mega-submenu-content__title">{{ $category->name }}</div>
                                            <a href="{{route('main')}}/?cat={{$category->id}}" class="mega-submenu-content__img">
                                                @if($category->photo)
                                                    <img src="/uploads/{{ $category->photo }}" alt="{{ $category->name }}">
                                                @else
                                                    <img src="{{ URL::asset('/front/images/missfashion-logo.png') }}" alt="Missfashion Logo" width="200px;">
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                @endif
                @if($menuItems)
                <ul class="nav navbar-nav navbar-right" id="main-menu">
                    @foreach($menuItems as $menuItem)
                            @if((count($menuItem->subitems) < 1))
                            <li>
                                <a href="#">{{ $menuItem->name }} </a>
                            @elseif((count($menuItem->subitems) > 1))
                            <li class="mega-submenu-wrap">
                                <a href="#">{{ $menuItem->name }} <span class="caret"></span></a>
                                <div class="mega-submenu">
                                <div class="mega-submenu-holder">
                                    <div class="mega-submenu-content">
                                        @foreach($menuItem->subitems as $subitem)
                                            <div class="mega-submenu-content__item">
                                                <div class="mega-submenu-content__title">{{ $subitem->name }}</div>
                                                <a href="{{ $subitem->link }}" class="mega-submenu-content__img">
                                                    @if($subitem->image)
                                                        <img src="/uploads/{{ $subitem->image }}" alt="{{ $subitem->name }}">
                                                    @else
                                                        <img src="{{ URL::asset('/front/images/missfashion-logo.png') }}" alt="Missfashion Logo" width="200px;">
                                                    @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                    @endforeach
                </ul>
                    @endif
        </div>
</nav>
</header>
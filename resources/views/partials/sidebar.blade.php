@inject('request', 'Illuminate\Http\Request')
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">
            
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.dashboard')</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('donor_access')
            <li class="{{ $request->segment(1) == 'donors' ? 'active' : '' }}">
                <a href="{{ route('donors.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.donor.title')</span>
                </a>
            </li>
            @endcan
            
            @can('category_access')
            <li class="{{ $request->segment(1) == 'categories' ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.categories.title')</span>
                </a>
            </li>
            @endcan
            
            @can('product_attribute_access')
            <li>
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span class="title">@lang('quickadmin.product-attributes.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                
                @can('image_access')
                <li class="{{ $request->segment(1) == 'images' ? 'active active-sub' : '' }}">
                        <a href="{{ route('images.index') }}">
                            <i class="fa fa-camera"></i>
                            <span class="title">
                                @lang('quickadmin.images.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('color_access')
                <li class="{{ $request->segment(1) == 'colors' ? 'active active-sub' : '' }}">
                        <a href="{{ route('colors.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">
                                @lang('quickadmin.colors.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('size_access')
                <li class="{{ $request->segment(1) == 'sizes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('sizes.index') }}">
                            <i class="fa fa-expand"></i>
                            <span class="title">
                                @lang('quickadmin.sizes.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('product_access')
            <li class="{{ $request->segment(1) == 'products' ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-server"></i>
                    <span class="title">@lang('quickadmin.products.title')</span>
                </a>
            </li>
            @endcan
            
            @can('slider_access')
            <li class="{{ $request->segment(1) == 'revslider' ? 'active' : '' }}">
                <a href="/revslider">
                    <i class="fa fa-align-left"></i>
                    <span class="title">Revolution Slider</span>
                </a>
            </li>
            @endcan

                <li class="{{ $request->segment(1) == 'contents' ? 'active' : '' }}">
                    <a href="{{ route('contents.edit') }}">
                        <i class="fa fa-align-left"></i>
                        <span class="title">Main page content block</span>
                    </a>
                </li>
                <li class="{{ $request->segment(1) == 'top_menu_items' ? 'active' : '' }}">
                    <a href="{{ route('top_menu_items.index') }}">
                        <i class="fa fa-align-left"></i>
                        <span class="title">Top menu items</span>
                    </a>
                </li>


            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.logout')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
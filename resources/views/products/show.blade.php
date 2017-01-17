@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.products.fields.category')</th>
                            <td>{{ $product->category->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.from-site-url')</th>
                            <td>{{ $product->from_site_url }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.source-url')</th>
                            <td>{{ $product->source_url }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.name')</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.sku')</th>
                            <td>{{ $product->sku }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.old-price')</th>
                            <td>{{ $product->old_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.new-price')</th>
                            <td>{{ $product->new_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.regular-price')</th>
                            <td>{{ $product->regular_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.sko-str')</th>
                            <td>{{ $product->sko_str }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.description')</th>
                            <td>{!! $product->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.first-accordion-content')</th>
                            <td>{!! $product->first_accordion_content !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.s-accordion-contentecond')</th>
                            <td>{!! $product->second_accordion_content !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.images')</th>
                            <td>
                                @foreach ($product->images as $singleImages)
                                    <span class="label label-info label-many">{{ $singleImages->url }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.colors')</th>
                            <td>
                                @foreach ($product->colors as $singleColors)
                                    <span class="label label-info label-many">{{ $singleColors->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.sizes')</th>
                            <td>
                                @foreach ($product->sizes as $singleSizes)
                                    <span class="label label-info label-many">{{ $singleSizes->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('products.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
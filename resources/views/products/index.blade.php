@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>
    @can('product_create')
    <p>
        <a href="{{ route('products.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped ajaxTable dt-select">
                <thead>
                    <tr>
                        @can('product_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.products.fields.category')</th>
                        <th>@lang('quickadmin.products.fields.source-url')</th>
                        <th>@lang('quickadmin.products.fields.name')</th>
                        <th>@lang('quickadmin.products.fields.sku')</th>
                        <th>@lang('quickadmin.products.fields.old-price')</th>
                        <th>@lang('quickadmin.products.fields.new-price')</th>
                        <th>@lang('quickadmin.products.fields.regular-price')</th>
                        <th>@lang('quickadmin.products.fields.description')</th>
                        <th>@lang('quickadmin.products.fields.first-accordion-content')</th>
                        <th>@lang('quickadmin.products.fields.second-accordion-content')</th>
                        <th>@lang('quickadmin.products.fields.images')</th>
                        <th>@lang('quickadmin.products.fields.colors')</th>
                        <th>@lang('quickadmin.products.fields.sizes')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('product_delete')
            window.route_mass_crud_entries_destroy = '{{ route('products.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('products.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                {data: 'category.name', name: 'category.name', defaultContent: ""},
                {data: 'source_url', name: 'source_url', defaultContent: ""},
                {data: 'name', name: 'name', defaultContent: ""},
                {data: 'sku', name: 'sku', defaultContent: ""},
                {data: 'old_price', name: 'old_price', defaultContent: ""},
                {data: 'new_price', name: 'new_price', defaultContent: ""},
                {data: 'regular_price', name: 'regular_price', defaultContent: ""},
                {data: 'description', name: 'description', defaultContent: ""},
                {data: 'first_accordion_content', name: 'first_accordion_content', defaultContent: ""},
                {data: 'second_accordion_content', name: 'second_accordion_content', defaultContent: ""},
                {data: 'images.url', name: 'images.url', defaultContent: ""},
                {data: 'colors.name', name: 'colors.name', defaultContent: ""},
                {data: 'sizes.name', name: 'sizes.name', defaultContent: ""},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
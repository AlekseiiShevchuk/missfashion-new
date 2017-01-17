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
            <table class="table table-bordered table-striped {{ count($products) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('product_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>Category</th>
                        <th>@lang('quickadmin.products.fields.from-site-url')</th>
                        <th>@lang('quickadmin.products.fields.source-url')</th>
                        <th>@lang('quickadmin.products.fields.name')</th>
                        <th>@lang('quickadmin.products.fields.sku')</th>
                        <th>@lang('quickadmin.products.fields.old-price')</th>
                        <th>@lang('quickadmin.products.fields.new-price')</th>
                        <th>@lang('quickadmin.products.fields.regular-price')</th>
                        <th>@lang('quickadmin.products.fields.sko-str')</th>
                        <th>@lang('quickadmin.products.fields.description')</th>
                        <th>@lang('quickadmin.products.fields.colors')</th>
                        <th>@lang('quickadmin.products.fields.sizes')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                @can('product_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $product->category->name or '' }}</td>
                                <td>{{ $product->from_site_url }}</td>
                                <td>{{ $product->source_url }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->old_price }}</td>
                                <td>{{ $product->new_price }}</td>
                                <td>{{ $product->regular_price }}</td>
                                <td>{{ $product->sko_str }}</td>
                                <td>{!! $product->description !!}</td>
                                <td>
                                    @foreach ($product->colors as $singleColors)
                                        <span class="label label-info label-many">{{ $singleColors->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->sizes as $singleSizes)
                                        <span class="label label-info label-many">{{ $singleSizes->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('product_view')
                                    <a href="{{ route('products.show',[$product->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('product_edit')
                                    <a href="{{ route('products.edit',[$product->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('product_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['products.destroy', $product->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="17">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('product_delete')
            window.route_mass_crud_entries_destroy = '{{ route('products.mass_destroy') }}';
        @endcan
    </script>
@endsection
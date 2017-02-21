@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    @can('category_create')
    <p>
        <a href="{{ route('categories.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
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
                        @can('category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.categories.fields.name')</th>
                        <th>@lang('quickadmin.categories.fields.parent')</th>
                        <th>@lang('quickadmin.categories.fields.photo')</th>
                        <th>@lang('quickadmin.categories.fields.donors')</th>
                        <th>Content Block</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('categories.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('categories.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                {data: 'name', name: 'name'},
                {data: 'parent.name', name: 'parent.name', defaultContent: ""},
                {data: 'photo', name: 'photo', defaultContent: ""},
                {data: 'donors.url', name: 'donors.url', defaultContent: ""},
                {data: 'content_block', name: 'content_block', defaultContent: ""},
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
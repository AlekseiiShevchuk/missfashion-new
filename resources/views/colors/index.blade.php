@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.colors.title')</h3>
    @can('color_create')
    <p>
        <a href="{{ route('colors.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
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
                        @can('color_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.colors.fields.name')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('color_delete')
            window.route_mass_crud_entries_destroy = '{{ route('colors.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('colors.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                {data: 'name', name: 'name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
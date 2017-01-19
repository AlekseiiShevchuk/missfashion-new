@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.donor.title')</h3>
    @can('donor_create')
    <p>
        <a href="{{ route('donors.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
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
                        @can('donor_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.donor.fields.url')</th>
                        <th>@lang('quickadmin.donor.fields.category')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('donor_delete')
            window.route_mass_crud_entries_destroy = '{{ route('donors.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('donors.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                {data: 'url', name: 'url'},
                {data: 'category.name', name: 'category.name', defaultContent: ""},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
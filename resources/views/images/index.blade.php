@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.images.title')</h3>
    @can('image_create')
    <p>
        <a href="{{ route('images.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
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
                        @can('image_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.images.fields.url')</th>
                        <th>local image path</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('image_delete')
            window.route_mass_crud_entries_destroy = '{{ route('images.mass_destroy') }}';
        @endcan
$(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('images.index') !!}';
            window.dtDefaultOptions.columns = [
                {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                {data: 'url', name: 'url'},
                {data: 'local_big_img', name: 'local_big_img'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection
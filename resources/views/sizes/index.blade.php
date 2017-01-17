@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sizes.title')</h3>
    @can('size_create')
    <p>
        <a href="{{ route('sizes.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($sizes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('size_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.sizes.fields.name')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($sizes) > 0)
                        @foreach ($sizes as $size)
                            <tr data-entry-id="{{ $size->id }}">
                                @can('size_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $size->name }}</td>
                                <td>
                                    @can('size_view')
                                    <a href="{{ route('sizes.show',[$size->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('size_edit')
                                    <a href="{{ route('sizes.edit',[$size->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('size_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['sizes.destroy', $size->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('size_delete')
            window.route_mass_crud_entries_destroy = '{{ route('sizes.mass_destroy') }}';
        @endcan
    </script>
@endsection
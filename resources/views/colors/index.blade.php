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
            <table class="table table-bordered table-striped {{ count($colors) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('color_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.colors.fields.name')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($colors) > 0)
                        @foreach ($colors as $color)
                            <tr data-entry-id="{{ $color->id }}">
                                @can('color_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $color->name }}</td>
                                <td>
                                    @can('color_view')
                                    <a href="{{ route('colors.show',[$color->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('color_edit')
                                    <a href="{{ route('colors.edit',[$color->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('color_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['colors.destroy', $color->id])) !!}
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
        @can('color_delete')
            window.route_mass_crud_entries_destroy = '{{ route('colors.mass_destroy') }}';
        @endcan
    </script>
@endsection
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
            <table class="table table-bordered table-striped {{ count($images) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('image_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.images.fields.url')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($images) > 0)
                        @foreach ($images as $image)
                            <tr data-entry-id="{{ $image->id }}">
                                @can('image_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $image->url }}</td>
                                <td>
                                    @can('image_view')
                                    <a href="{{ route('images.show',[$image->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('image_edit')
                                    <a href="{{ route('images.edit',[$image->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('image_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['images.destroy', $image->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('image_delete')
            window.route_mass_crud_entries_destroy = '{{ route('images.mass_destroy') }}';
        @endcan
    </script>
@endsection
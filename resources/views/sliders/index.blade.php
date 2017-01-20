@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.slider.title')</h3>
    @can('slider_create')
    <p>
        <a href="{{ route('sliders.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($sliders) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('slider_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.slider.fields.slider-image')</th>
                        <th>@lang('quickadmin.slider.fields.description')</th>
                        <th>@lang('quickadmin.slider.fields.is-active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($sliders) > 0)
                        @foreach ($sliders as $slider)
                            <tr data-entry-id="{{ $slider->id }}">
                                @can('slider_delete')
                                    <td></td>
                                @endcan

                                <td>@if($slider->slider_image)<a href="{{ asset('uploads/' . $slider->slider_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $slider->slider_image) }}"/></a>@endif</td>
                                <td>{{ $slider->description }}</td>
                                <td>{{ Form::checkbox("is_active", 1, $slider->is_active == 1, ["disabled"]) }}</td>
                                <td>
                                    @can('slider_view')
                                    <a href="{{ route('sliders.show',[$slider->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('slider_edit')
                                    <a href="{{ route('sliders.edit',[$slider->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('slider_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['sliders.destroy', $slider->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('slider_delete')
            window.route_mass_crud_entries_destroy = '{{ route('sliders.mass_destroy') }}';
        @endcan

    </script>
@endsection
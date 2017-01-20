@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.slider.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.slider.fields.slider-image')</th>
                            <td>@if($slider->slider_image)<a href="{{ asset('uploads/' . $slider->slider_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $slider->slider_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.slider.fields.description')</th>
                            <td>{{ $slider->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.slider.fields.is-active')</th>
                            <td>{{ Form::checkbox("is_active", 1, $slider->is_active == 1, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('sliders.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
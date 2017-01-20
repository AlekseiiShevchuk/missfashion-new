@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.slider.title')</h3>
    
    {!! Form::model($slider, ['method' => 'PUT', 'route' => ['sliders.update', $slider->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($slider->slider_image)
                        <a href="{{ asset('uploads/'.$slider->slider_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/'.$slider->slider_image) }}"></a>
                    @endif
                    {!! Form::label('slider_image', 'Slider image', ['class' => 'control-label']) !!}
                    {!! Form::file('slider_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('slider_image_max_size', 4) !!}
                    {!! Form::hidden('slider_image_max_width', 1900) !!}
                    {!! Form::hidden('slider_image_max_height', 1200) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slider_image'))
                        <p class="help-block">
                            {{ $errors->first('slider_image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_active', 'Is active?*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_active', 0) !!}
                    {!! Form::checkbox('is_active', 1, old('is_active')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_active'))
                        <p class="help-block">
                            {{ $errors->first('is_active') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


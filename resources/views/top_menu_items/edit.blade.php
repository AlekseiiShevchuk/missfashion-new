@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.top-menu-items.title')</h3>
    
    {!! Form::model($top_menu_item, ['method' => 'PUT', 'route' => ['top_menu_items.update', $top_menu_item->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('link', 'Link', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('link'))
                        <p class="help-block">
                            {{ $errors->first('link') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_main', 'select menu item type*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_main', 0) !!}
                    {!! Form::select('is_main', [0 => 'Sub item', 1 => 'Main Item'], old('is_main'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_main'))
                        <p class="help-block">
                            {{ $errors->first('is_main') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($top_menu_item->image)
                        <a href="{{ asset('uploads/'.$top_menu_item->image) }}" target="_blank"><img src="{{ asset('uploads/thumb/'.$top_menu_item->image) }}"></a>
                    @endif
                    {!! Form::label('image', 'Image for SubMenu item (have sense only for subItems)', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_max_size', 8) !!}
                    {!! Form::hidden('image_max_width', 4000) !!}
                    {!! Form::hidden('image_max_height', 4000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('subitems', 'Subitems (have sense only for Main Item)', ['class' => 'control-label']) !!}
                    {!! Form::select('subitems[]', $subitems, old('subitems') ? old('subitems') : $top_menu_item->subitems->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('subitems'))
                        <p class="help-block">
                            {{ $errors->first('subitems') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


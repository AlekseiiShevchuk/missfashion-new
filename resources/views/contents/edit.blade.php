@extends('layouts.app')

@section('content')
    <h3 class="page-title">Edit content block for main page</h3>

    {!! Form::open(['method' => 'PUT', 'route' => ['contents.update']]) !!}

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('value', 'Content block for main page', ['class' => 'control-label']) !!}
                {!! Form::textarea('value', $content, ['class' => 'form-control editor', 'placeholder' => '']) !!}
                <br>
                {!! Form::label('title', 'Title for Products-block on main page', ['class' => 'control-label']) !!}
                {!! Form::text('title', $title, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
            CKEDITOR.replace($(this).attr('id'));
        });
    </script>

@stop
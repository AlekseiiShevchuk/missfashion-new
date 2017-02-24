@extends('layouts.app')

@section('content')
    <h3 class="page-title">Edit referel link prefix</h3>

    {!! Form::open(['method' => 'PUT', 'route' => ['contents.updateRefLink']]) !!}

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('value', 'Referal link Prefix', ['class' => 'control-label']) !!}
                {!! Form::textarea('value', $content, ['class' => 'form-control editor', 'placeholder' => '']) !!}
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
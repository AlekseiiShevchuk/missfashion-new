@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.contents.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.contents.fields.name')</th>
                            <td>{{ $content->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.contents.fields.description')</th>
                            <td>{{ $content->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.contents.fields.is_active')</th>
                            <td>{{ Form::checkbox("is_active", 1, $content->is_active == 1, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <p>&nbsp;</p>

            <a href="{{ route('contents.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
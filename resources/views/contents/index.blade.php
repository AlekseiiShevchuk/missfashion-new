@extends('layouts.app')

@section('content')

    <h3 class="page-title">@lang('quickadmin.contents.title')</h3>
    <p>
        <a href="{{ route('contents.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>
    </div>

    <div class="panel-body">
        <table class="table table-bordered table-striped {{ count($contents) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
            <tr>
                <th></th>
                <th>@lang('quickadmin.contents.fields.name')</th>
                <th>@lang('quickadmin.contents.fields.description')</th>
                <th>@lang('quickadmin.contents.fields.is_active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($contents) > 0)
                @foreach ($contents as $content)
                    <tr data-entry-id="{{ $content->id }}">
                        <td></td>
                        <td>{{ $content->name }}</td>
                        <td>{{ $content->description }}</td>
                        <td>{{ Form::checkbox("is_active", 1, $content->is_active == 1, ["disabled"]) }}</td>
                        <td>
                            <a href="{{ route('contents.show',[$content->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                            <a href="{{ route('contents.edit',[$content->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                            {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['contents.destroy', $content->id])) !!}
                            {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('contents.mass_destroy') }}';
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.top-menu-items.title')</h3>
    <p>
        <a href="{{ route('top_menu_items.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($top_menu_items) > 0 ? 'datatable' : '' }} dt-select ">
                <thead>
                    <tr>
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('quickadmin.top-menu-items.fields.name')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.link')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.is-main')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.image')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.subitems')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($top_menu_items) > 0)
                        @foreach ($top_menu_items as $top_menu_item)
                            <tr data-entry-id="{{ $top_menu_item->id }}">
                                    <td></td>

                                <td>{{ $top_menu_item->name }}</td>
                                <td>{{ $top_menu_item->link }}</td>
                                <td>
                                @if($top_menu_item->is_main == 1)
                                    <div class="btn-success">Main Item</div>
                                @endif
                                @if($top_menu_item->is_main == 0)
                                    <div class="btn-info">Sub Item</div>
                                @endif
                                </td>
                                <td>@if($top_menu_item->image)<a href="{{ asset('uploads/' . $top_menu_item->image) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $top_menu_item->image) }}"/></a>@endif</td>
                                <td>
                                    @foreach ($top_menu_item->subitems as $singleSubitems)
                                        <span class="label label-info label-many">{{ $singleSubitems->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('top_menu_items.show',[$top_menu_item->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('top_menu_items.edit',[$top_menu_item->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['top_menu_items.destroy', $top_menu_item->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
            window.route_mass_crud_entries_destroy = '{{ route('top_menu_items.mass_destroy') }}';
    </script>
@endsection
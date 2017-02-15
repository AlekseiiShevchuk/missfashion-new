@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.top-menu-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.top-menu-items.fields.name')</th>
                            <td>{{ $top_menu_item->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.top-menu-items.fields.link')</th>
                            <td>{{ $top_menu_item->link }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.top-menu-items.fields.is-main')</th>
                            <td>{{ Form::checkbox("is_main", 1, $top_menu_item->is_main == 1, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.top-menu-items.fields.image')</th>
                            <td>@if($top_menu_item->image)<a href="{{ asset('uploads/' . $top_menu_item->image) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $top_menu_item->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.top-menu-items.fields.subitems')</th>
                            <td>
                                @foreach ($top_menu_item->subitems as $singleSubitems)
                                    <span class="label label-info label-many">{{ $singleSubitems->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#topmenuitems" aria-controls="topmenuitems" role="tab" data-toggle="tab">Sub menu items</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="topmenuitems">
<table class="table table-bordered table-striped {{ count($top_menu_item->subitems) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.top-menu-items.fields.name')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.link')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.is-main')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.image')</th>
                        <th>@lang('quickadmin.top-menu-items.fields.subitems')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($top_menu_item->subitems) > 0)
            @foreach ($top_menu_item->subitems as $top_menu_item)
                <tr data-entry-id="{{ $top_menu_item->id }}">
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

            <p>&nbsp;</p>

            <a href="{{ route('top_menu_items.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
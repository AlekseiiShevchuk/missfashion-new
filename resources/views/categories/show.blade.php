@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.categories.fields.name')</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.parent')</th>
                            <td>{{ $category->parent->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.photo')</th>
                            <td>@if($category->photo)<a href="{{ asset('uploads/' . $category->photo) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $category->photo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.categories.fields.donors')</th>
                            <td>
                                @foreach ($category->donors as $singleDonors)
                                    <span class="label label-info label-many">{{ $singleDonors->url }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('categories.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
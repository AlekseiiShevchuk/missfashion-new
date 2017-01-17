@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.colors.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.colors.fields.name')</th>
                            <td>{{ $color->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.colors.fields.products')</th>
                            <td>
                                @foreach ($color->products as $singleProducts)
                                    <span class="label label-info label-many">{{ $singleProducts->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('colors.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop
@extends('backend.layouts.master')

@section('page-header')
    <h1>{!! trans('strings.backend.settings.index') !!}</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Settings</h3>
        <div class="pull-right box-tools">
			<a href="{{ route('admin.settings.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> {{ trans('strings.backend.form.create') }}</a>
		</div>
    </div>

    <div class="box-body">
    	<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Type</th>
                    <th class="visible-lg">Created</th>
                    <th class="visible-lg">Last Updated</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->id }}</td>
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->skey }}</td>
                        <td>{{ $setting->value }}</td>
                        <td>{{ $setting->type }}</td>
                        <td class="visible-lg">{{ $setting->created_at->diffForHumans() }}</td>
                        <td class="visible-lg">{{ $setting->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{!! route('admin.settings.edit', $setting) !!}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Sửa"></i></a>
                            <a href="{!! route('admin.settings.destroy', $setting) !!}"
                             data-method="delete"
                             data-trans-button-cancel="Hủy"
                             data-trans-button-confirm="Xóa"
                             data-trans-title="Are you sure?"
                             class="btn btn-xs btn-danger">
                                <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Xóa"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @if(count($settings) == 0)
                    <tr><td colspan="7" class="warning">No data</td></tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="pull-left">
            {{ count($settings) }} total
        </div>

        <div class="pull-right">

        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop
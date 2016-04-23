@extends('backend.layouts.master')

@section('page-header')
    <h1>{!! trans('strings.backend.blog.category.index') !!}</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Blog Categories</h3>
        <div class="pull-right box-tools">
			<a href="{{ route('admin.blog.categories.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> {{ trans('strings.backend.form.create') }}</a>
		</div>
    </div>

    <div class="box-body">
    	<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    @foreach (array_keys(config('locale.languages')) as $index => $lang)
                    <th>{{ trans('menus.language-picker.langs.'.$lang) }}</th>
                    @endforeach
                    <th class="visible-lg">Created</th>
                    <th class="visible-lg">Last Updated</th>
                    <th>H&agrave;nh động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        @foreach (array_keys(config('locale.languages')) as $index => $lang)
                        <td>@if($category->hasTranslation($lang)) {{ $category->translate($lang)->name }} @endif</td>
                        @endforeach
                        <td class="visible-lg">{{ $category->created_at->diffForHumans() }}</td>
                        <td class="visible-lg">{{ $category->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{!! route('admin.blog.categories.edit', $category) !!}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Sửa"></i></a>
                            <a href="{!! route('admin.blog.categories.destroy', $category) !!}"
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
                    @if(count($categories) == 0)
                    <tr><td colspan="9" class="warning">No data</td></tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="pull-left">
            {{ count($categories) }} total
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop
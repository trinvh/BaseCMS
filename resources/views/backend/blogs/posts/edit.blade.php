@extends('backend.layouts.master')

@section('page-header')
    <h1>{!! trans('strings.backend.blog.posts.edit') !!}</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{!! trans('strings.backend.blog.posts.edit') !!}</h3>
    </div>

    <div class="box-body">
    	{!! BootForm::open()->action(route('admin.blog.posts.update', $post))->put() !!}
        {!! BootForm::bind($post) !!}
        @include('backend.blogs.posts.form')
        <div class="box-footer">
            <a href="{!! route('admin.blog.categories.index') !!}" class="btn btn-default pull-right">Cancel</a>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        {!! BootForm::close() !!}
    </div>
</div>
@stop
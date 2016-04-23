@extends('frontend.layouts.master')

@section('content')
<h1 class="page-header">{{ $page->name }}</h1>
{!! \Blade::compileString($page->content) !!}
@stop
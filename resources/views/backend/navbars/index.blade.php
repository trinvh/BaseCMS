@extends('backend.layouts.master')

@section('page-header')
    <h1>Menu [{{ $navbar->name }}]</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Menus</h3>
    </div>

    <div class="box-body">
        <div class="col-md-5 col-sm-12">
        @include('backend.navbars.rootmenus')
        </div>
        <div class="col-md-7 col-sm-12">
            {!! BootForm::open()->action(route('admin.navbars.update', $navbar))->put() !!}
            {!! BootForm::bind($navbar) !!}
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu [{{ $navbar->name }}]</h3>
                </div>

                <div class="box-body">
                    @include('backend.navbars.form')
                </div>
                <div class="box-footer">
                    <a href="{!! route('admin.navbars.destroy', $navbar) !!}"
                        data-method="delete"
                        data-trans-button-cancel="Cancel"
                        data-trans-button-confirm="Delete"
                        data-trans-title="Are you sure?"
                        class="btn btn-danger pull-right">Delete <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>
            {!! BootForm::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop

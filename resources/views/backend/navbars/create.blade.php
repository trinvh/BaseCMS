@extends('backend.layouts.master')

@section('page-header')
    <h1>{{ trans('strings.backend.navbars.create') }}</h1>
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
            {!! BootForm::open()->action(route('admin.navbars.store')) !!}
            {!! BootForm::bind($navbar) !!}
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('strings.backend.navbars.create') }}</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! BootForm::select('Select parent', 'parent_id', $menus->lists('name', 'id'))->addOption(0, '--- Select root ---', false)->select(0) !!}
                        </div>
                    </div>
                    @include('backend.navbars.form')
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-default pull-right">Cancel</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>
            {!! BootForm::close() !!}
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop

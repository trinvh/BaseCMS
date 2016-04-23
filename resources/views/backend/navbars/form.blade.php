<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach (array_keys(config('locale.languages')) as $index => $lang)
	        <li @if($index==0) class="active" @endif><a href="#menu-{{$lang}}" data-toggle="tab">{{ trans('menus.language-picker.langs.'.$lang) }}</a></li>
	    @endforeach
    </ul>
    <div class="tab-content">
    	@foreach (array_keys(config('locale.languages')) as $index => $lang)
    	<div class="tab-pane @if($index==0) active @endif" id="menu-{{$lang}}">
    		{!! TranslatableBootForm::text('Name','name')->required()->renderLocale($lang) !!}
    		{!! TranslatableBootForm::text('Url','url')->required()->renderLocale($lang) !!}
    		{!! TranslatableBootForm::text('Description','description')->renderLocale($lang) !!}
    	</div>
    	@endforeach
    </div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::text('Icon','icon') !!}
	</div>
	<div class="col-md-6">
		{!! BootForm::text('Permission','permission') !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::select('Open', 'open', ['Same'=>'Same', 'New'=>'New'])->select($navbar->open) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::checkbox('Status', 'status', '1')->defaultCheckedState($navbar->status == true) !!}
	</div>
</div>
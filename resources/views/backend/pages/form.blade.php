<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach (array_keys(config('locale.languages')) as $index => $lang)
	        <li @if($index==0) class="active" @endif><a href="#page-{{$lang}}" data-toggle="tab">{{ trans('menus.language-picker.langs.'.$lang) }}</a></li>
	    @endforeach
    </ul>
    <div class="tab-content">
    	@foreach (array_keys(config('locale.languages')) as $index => $lang)
    	<div class="tab-pane @if($index==0) active @endif" id="page-{{$lang}}">
			<div class="row">
				<div class="col-md-8">
    				<div class="row">
    					<div class="col-md-6">
		    				{!! TranslatableBootForm::text('Name','name')->renderLocale($lang) !!}
		    			</div>
		    			<div class="col-md-6">
		    				{!! TranslatableBootForm::text('Slug','slug')->disabled()->renderLocale($lang) !!}
		    			</div>
		    		</div>
		    		{!! TranslatableBootForm::textarea('Content','content')->addClass('editor')->renderLocale($lang) !!}
		    	</div>
		    	<div class="col-md-4">
		    		{!! TranslatableBootForm::text('Keywords','keyword')->renderLocale($lang) !!}
    				{!! TranslatableBootForm::textarea('Description','description')->renderLocale($lang) !!}
		    	</div>
		    </div>
    	</div>
    	@endforeach
    </div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::text('Permission','permission') !!}
	</div>
	<div class="col-md-6">
		{!! BootForm::select('Compiler', 'compiler', ['html'=>'HTML', 'blade'=>'Blade'])->select($page->compiler) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::checkbox('Status', 'status', '1')->defaultCheckedState($page->status == true) !!}
	</div>
</div>
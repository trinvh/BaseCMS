<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach (array_keys(config('locale.languages')) as $index => $lang)
	        <li @if($index==0) class="active" @endif><a href="#category-{{$lang}}" data-toggle="tab">{{ trans('menus.language-picker.langs.'.$lang) }}</a></li>
	    @endforeach
    </ul>
    <div class="tab-content">
    	@foreach (array_keys(config('locale.languages')) as $index => $lang)
    	<div class="tab-pane @if($index==0) active @endif" id="category-{{$lang}}">
			<div class="row">
				<div class="col-md-8">
    				<div class="row">
    					<div class="col-md-6">
		    				{!! TranslatableBootForm::text('Title','name')->renderLocale($lang) !!}
		    			</div>
		    			<div class="col-md-6">
		    				{!! TranslatableBootForm::text('Slug','slug')->disabled()->renderLocale($lang) !!}
		    			</div>
		    		</div>
		    		{!! TranslatableBootForm::textarea('Description','description')->renderLocale($lang) !!}
		    	</div>
		    	<div class="col-md-4">
		    		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		    	</div>
		    </div>
    	</div>
    	@endforeach
    </div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! Form::fileImage('image', $category->image) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::checkbox('Status', 'status', '1')->defaultCheckedState($category->status == true) !!}
	</div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach (array_keys(config('locale.languages')) as $index => $lang)
	        <li @if($index==0) class="active" @endif><a href="#post-{{$lang}}" data-toggle="tab">{{ trans('menus.language-picker.langs.'.$lang) }}</a></li>
	    @endforeach
    </ul>
    <div class="tab-content">
    	@foreach (array_keys(config('locale.languages')) as $index => $lang)
    	<div class="tab-pane @if($index==0) active @endif" id="post-{{$lang}}">
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
	<div class="col-md-6 col-sm-12">
		{!! BootForm::select('Categories', 'categories[]', $categories)->addClass('select2')->attribute('multiple', true)
				->select(old('categories', $post->categories()->lists('id')->toArray())) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! Form::fileImage('image', $post->image) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::checkbox('Status', 'status', '1')->defaultCheckedState($post->status == true) !!}
	</div>
</div>
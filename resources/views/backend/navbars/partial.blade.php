<ol class="dd-list">
	@foreach($menu->children()->get() as $submenu)
	<li class="dd-item dd3-item" data-id="{{$submenu->id}}">
	    <div class="dd-handle dd3-handle">Drag</div>
	    <div class="dd3-content">
	    	<a href="{!! route('admin.navbars.show', $submenu->id) !!}">{{$submenu->name}} <span class="pull-right"><i class="fa fa-angle-double-right"></i></span></a>
	    </div>
	    @include('backend.navbars.partial', ['menu' => $submenu])
	</li>
	@endforeach
</ol>
<div class="row">
	<div class="col-md-6">
		{!! BootForm::text('Name','name') !!}
		{!! BootForm::text('Key','skey') !!}
		{!! BootForm::select('Type', 'type', ['System'=>'Sytem', 'Default'=>'Default', 'User' => 'User'])->select($setting->type) !!}
	</div>
	<div class="col-md-6">
		{!! BootForm::textarea('Value','value') !!}
	</div>
</div>
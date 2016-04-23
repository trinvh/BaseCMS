<?php

namespace App\Models\Menu;
use App\Classes\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends \Baum\Node {
	use Translatable;
	use SoftDeletes;

	public $translatedAttributes = ['name', 'description', 'url'];

	protected $table = "menus";

	public static $rules = [
		'*.name' => 'required',
		'*.url' => 'required',
	];
}

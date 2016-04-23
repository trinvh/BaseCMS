<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	use \App\Classes\Scope;

	protected $table = "settings";

	protected $fillable = ['name', 'skey', 'value', 'type'];

	public static $rules = [
		'name' => 'required',
		'skey' => 'required|unique:settings',
	];
}

<?php

namespace App\Models\Page;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {
	use Translatable;
	use SoftDeletes;
	use \App\Classes\Scope;

	public $translatedAttributes = ['name', 'content', 'slug', 'keyword', 'description'];

	protected $fillable = ['compiler', 'status', 'permission', 'name', 'content', 'slug', 'keyword', 'description'];

	protected $table = "pages";

	public static $rules = [
		'*.name' => 'required',
		'*.content' => 'required',
	];

	public function getLinkAttribute() {
		return url($this->slug . '.html');
	}
}

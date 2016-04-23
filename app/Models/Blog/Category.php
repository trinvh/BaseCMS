<?php

namespace App\Models\Blog;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
	use Translatable;
	use SoftDeletes;
	use \App\Classes\Scope;

	protected $table = "blog_categories";

	protected $translatedAttributes = ['name', 'slug', 'description'];

	protected $translationForeignKey = "blog_category_id";

	protected $fillable = ['name','slug','description','image'];

	public static function getRules() {
		return [
			config('app.locale').'.name' => 'required',
		];
	}

	public static function getListsForSelect() {
		$list = static::all();
		foreach($list as $item) {
			$data[$item->id] = $item->name;
		}
		return $data;
	}
}

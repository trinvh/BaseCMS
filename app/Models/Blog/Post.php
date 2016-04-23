<?php

namespace App\Models\Blog;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
	use Translatable;
	use SoftDeletes;
	use \App\Classes\Scope;

	protected $table = "blogs";

	protected $translatedAttributes = ['name', 'slug', 'content', 'description'];

	protected $translationForeignKey = "blog_id";

	protected $fillable = ['name','slug', 'content', 'description','image', 'private', 'status', 'user_id'];

	public static function getRules() {
		return [
			config('app.locale').'.name' => 'required|max:255',
			config('app.locale').'.content'	=> 'required'
		];
	}

	public function user() {
		return $this->belongsTo(\App\Models\Access\User\User::class);
	}

	public function categories() {
		return $this->belongsToMany(Category::class, 'blog_post_category', 'blog_id', 'blog_category_id');
	}
}

<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model {
	use \App\Classes\Sluggable;

	public $table = "blog_translations";

	public $timestamps = false;
}

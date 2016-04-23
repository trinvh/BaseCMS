<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model {
	use \App\Classes\Sluggable;

	public $table = "blog_category_translations";

	public $timestamps = false;
}

<?php

namespace App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model {

	use \App\Classes\Sluggable;

	public $table = "page_translations";

	protected $fillable = ['name', 'slug', 'content', 'keyword', 'description'];

	protected $append = ['page'];

	public $timestamps = false;

	public function page() {
		return $this->belongsTo(Page::class, 'page_id', 'id');
	}
}

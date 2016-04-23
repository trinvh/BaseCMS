<?php namespace App\Classes;

trait Sluggable {

	public static function bootSluggable() {
		static::creating(function ($model) {
			$model->slug = str_slug($model->name);
		});
	}
}
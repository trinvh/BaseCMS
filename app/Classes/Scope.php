<?php
namespace App\Classes;

trait Scope {

	public function scopeLastest($query) {
		$query->orderBy('updated_at', 'desc');
	}
}
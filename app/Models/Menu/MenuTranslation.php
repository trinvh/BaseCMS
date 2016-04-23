<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model {
	protected $table = "menu_translations";

	protected $fillable = ['name', 'description', 'url'];

	public $timestamps = false;

}

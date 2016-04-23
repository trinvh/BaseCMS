<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Image;

class ImageController extends Controller {
	public function getResize($width, $height, $filename) {
		if (file_exists($filename)) {
			$img = Image::cache(function ($image) use ($filename, $width, $height) {
				if ($width == 0) {
					return $image->make('' . $filename)->heighten($height);
				} else if ($height == 0) {
					return $image->make('' . $filename)->widen($width);
				} else {
					return $image->make('' . $filename)->resize($width, $height, function ($cons) {
						$cons->aspectRatio();
					})->resizeCanvas($width, $height);
				}
			});
			return response()->make($img, 200, array('Content-Type' => 'image/jpeg'));
		} else {
			return 'file not found';
		}
	}
}

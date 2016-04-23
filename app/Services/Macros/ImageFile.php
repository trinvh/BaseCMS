<?php
namespace App\Services\Macros;

/**
 * Class Dropdowns
 * @package App\Services\Macros
 */
trait ImageFile {

	public function fileImage($name, $value, $options = []) {
		$placeholder = url('images/no-image.gif');
		$image = $value == '' ? $placeholder : $value;
		$id = 'img-callback-' . str_random(4);
		return $this->hidden($name, $value, $options)
			. '<a class="img-thumbnail picker" id="' . $id . '" data-toggle="image">
		            <img src="' . $image . '" data-placeholder="' . $placeholder . '" />
		        </a>';
	}
}
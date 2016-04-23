<?php
namespace App\Services;

use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;

class UploadsManager {

	protected $disk;

	public function __construct() {
		$this->disk = Storage::disk(config('trinvh.uploads.storage'));
	}

	public function folderInfo($folder) {
		$folder = $this->cleanFolder($folder);

		$breadcrumbs = $this->breadcrumbs($folder);
		$slice = array_slice($breadcrumbs, -1);
		$folderName = current($slice);
		$breadcrumbs = array_slice($breadcrumbs, 0, -1);

		$files = [];

		foreach ($this->disk->directories($folder) as $path) {
			$files[] = $this->folderDetails($path);
		}
		foreach ($this->disk->files($folder) as $path) {
			$files[] = $this->fileDetails($path);
		}
		//dd($files);

		return compact(
			'folder',
			'folderName',
			'breadcrumbs',
			'subfolders',
			'files'
		);
	}

	public function createDirectory($folder) {
		$folder = $this->cleanFolder($folder);

		if ($this->disk->exists($folder)) {
			return 'Folder ' . $folder . ' already exists';
		}

		return $this->disk->makeDirectory($folder);
	}

	public function delete($pathArray) {
		foreach($pathArray as $path) {
			if($this->isFile($path)) {
				$this->disk->delete($path);
			} else {
				$this->disk->deleteDirectory($path);
			}
		}
		return true;
	}

	public function saveFile($path, $content) {
		$path = $this->cleanFolder($path);
		if ($this->disk->exists($path)) {
			return 'File already exists';
		}

		return $this->disk->put($path, $content);
	}

	/**
	 * Sanitize the folder name
	 */

	protected function cleanFolder($folder) {
		return '/' . trim(str_replace('..', '', $folder), '/');
	}

	protected function breadcrumbs($folder) {
		$folder = trim($folder, '/');
		$crumbs = ['/' => 'Main'];

		if (empty($folder)) {
			return $crumbs;
		}

		$folders = explode('/', $folder);
		$build = '';
		foreach ($folders as $folder) {
			$build .= '/' . $folder;
			$crumbs[$build] = $folder;
		}

		return $crumbs;
	}

	protected function folderDetails($path) {
		$path = '/' . ltrim($path, '/');

		return [
			'name' => basename($path),
			'localPath' => $path,
			'is_file' => $this->isFile($path),
			'modified' => $this->fileModified($path),
		];
	}

	protected function fileDetails($path) {
		$path = '/' . ltrim($path, '/');

		return [
			'name' => basename($path),
			'path' => $this->filePath($path),
			'localPath' => $path,
			'thumb' => $this->fileThumb($path),
			'is_file' => $this->isFile($path),
			'size' => $this->fileSize($path),
			'modified' => $this->fileModified($path),
		];
	}

	protected function filePath($path) {
		$path = rtrim(config('trinvh.uploads.webpath'), '/') . '/' . ltrim($path, '/');
		return $path;
	}

	protected function fileThumb($path) {
		return url('images/100/0' . $this->filePath($path));
	}

	protected function isFile($path) {
		return File::isFile(public_path() . $this->filePath($path));
	}

	protected function fileSize($path) {
		return $this->disk->size($path);
	}

	protected function fileModified($path) {
		return Carbon::createFromTimestamp(
			$this->disk->lastModified($path)
		)->diffForHumans();
	}

}
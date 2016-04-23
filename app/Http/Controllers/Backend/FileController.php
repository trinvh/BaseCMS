<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UploadsManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller {
	protected $manager;

	public function __construct(UploadsManager $manager) {
		$this->manager = $manager;
	}

	public function index(Request $request) {
		$thumb = $request->get('thumb');
		$folder = $request->get('folder');
		$data = $this->manager->folderInfo($folder);

		return view('backend.filemanager.modal', $data)
			->withThumb($thumb);
	}

	public function store(Request $request) {
		$file = $_FILES['file'];
		$fileName = $request->get('file_name');
		$fileName = $fileName ?: $file['name'];
		$path = str_finish($request->get('folder'), '/') . $fileName;
		$content = File::get($file['tmp_name']);

		$result = $this->manager->saveFile($path, $content);

		if ($result === true) {
			return response()->json(['success' => true]);
		}

		$error = $result ?: "An error occurred uploading file.";
		return response()->json(['error' => $error]);
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		//
	}

	public function update(Request $request, $id) {

	}

	public function destroy(Request $request) {
		$this->manager->delete($request->get('path'));
		return response()->json(['success' => 'Xóa thành công']);
	}

	public function postFolder(Request $request) {
		$new_folder = $request->get('new_folder');
		$folder = $request->get('folder') . '/' . $new_folder;

		$result = $this->manager->createDirectory($folder);

		if ($result === true) {
			return response()->json([
				'success' => true,
			]);
		}

		$error = $result ?: "An error occurred creating directory.";
		return response()->json([
			'error' => $error,
		]);
	}

	public function deleteFile(Request $request, $id) {
		$del_file = $request->get('del_file');
		$path = $request->get('folder') . '/' . $del_file;

		$result = $this->manager->deleteFile($path);

		if ($result === true) {
			return redirect()
				->back()
				->withSuccess("File '$del_file' deleted.");
		}

		$error = $result ?: "An error occurred deleting file.";
		return redirect()
			->back()
			->withErrors([$error]);
	}

	/**
	 * Delete a folder
	 */
	public function deleteFolder(Request $request) {
		$del_folder = $request->get('del_folder');
		$folder = $request->get('folder') . '/' . $del_folder;

		$result = $this->manager->deleteDirectory($folder);

		if ($result === true) {
			return redirect()
				->back()
				->withSuccess("Folder '$del_folder' deleted.");
		}

		$error = $result ?: "An error occurred deleting directory.";
		return redirect()
			->back()
			->withErrors([$error]);
	}
}

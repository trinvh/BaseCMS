<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use Illuminate\Http\Request;

class NavbarController extends Controller {

	public function __construct() {
		$menus = Menu::roots()->get();
		view()->share('menus', $menus);
	}

	public function index(Request $request) {
		return redirect(route('admin.navbars.show', Menu::first()));
	}

	public function show($id) {
		$navbar = Menu::findOrFail($id);
		return view('backend.navbars.index')->withNavbar($navbar);
	}

	public function orders(Request $request) {
		$rootNode = Menu::find(1);
		if ($rootNode) {

			$rootNode->makeTree($request->get('children'));
			Menu::rebuild();
			return response()->json(['success' => true, 'message' => 'Lưu thành công']);
		}
		return response()->json(['success' => false, 'message' => 'Không thể lưu']);
	}

	public function create(Request $request) {
		$navbar = new Menu();
		return view('backend.navbars.create')->withNavbar($navbar);
	}

	public function store(Request $request) {
		$this->validate($request, Menu::$rules);
		$inputs = $request->all();
		$inputs['status'] = $request->has('status');

		$newMenu = Menu::create($inputs);

		if ($inputs['parent_id'] > 0) {
			$newMenu->makeChildOf($inputs['parent_id']);
		}

		return redirect()->back()->withFlashSuccess('Saved successfully');

	}

	public function update($id, Request $request) {
		$navbar = Menu::find($id);
		if ($navbar) {
			$this->validate($request, Menu::$rules);

			$inputs = $request->all();
			$inputs['status'] = $request->has('status');

			$navbar->update($inputs);
			return redirect()->back()->withFlashSuccess('Saved successfully');
		}
		abort(404);
	}

	public function destroy($id) {
		if ($id == 1) {
			return back()->withFlashDanger('Could not remove root menu');
		}
		Menu::destroy($id);
		return redirect(route('admin.navbars.index'))->withFlassSuccess("Deleted successfully");
	}
}

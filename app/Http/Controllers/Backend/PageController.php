<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class PageController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$pages = Page::lastest()->paginate(20);
		return view('backend.pages.index')->withPages($pages);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$page = new Page();
		$page->status = true;
		return view('backend.pages.create')->withPage($page);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, Page::$rules);

		$inputs = $request->all();
		$inputs['status'] = $request->has('status');

		$newPage = Page::create($inputs);
		return redirect()->route('admin.pages.index')->withFlashSuccess('Saved successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$page = Page::findOrFail($id);

		return view('backend.pages.edit')->withPage($page);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, Page::$rules);

		$inputs = $request->all();
		$inputs['status'] = $request->has('status');

		$page = Page::findOrFail($id);
		// NOTE: Cannot use save($inputs) - make a contribute
		$page->fill($inputs);
		$page->save();
		return redirect()->route('admin.pages.index')->withFlashSuccess('Saved successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Page::destroy($id);
		return back()->withFlashSuccess("Delete successfully");
	}
}

<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categories = Category::lastest()->get();
		return view('backend.blogs.categories.index')->withCategories($categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$category = new Category();
		return view('backend.blogs.categories.create')->withCategory($category);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, Category::getRules());

		$inputs = $request->all();
		$category = Category::create($inputs);

		return redirect()->route('admin.blog.categories.index')->withFlashSuccess("Saved successfully");
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
		$category = Category::findOrFail($id);
		return view('backend.blogs.categories.edit')->withCategory($category);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$category = Category::findOrFail($id);
		$this->validate($request, Category::getRules());

		$inputs = $request->all();
		$category->fill($inputs);
		$category->save();

		return redirect()->route('admin.blog.categories.index')->withFlashSuccess("Saved successfully");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Category::destroy($id);
		return redirect()->route('admin.blog.categories.index')->withFlashSuccess("Deleted successfully");
	}
}

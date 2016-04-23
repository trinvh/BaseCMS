<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$settings = Setting::lastest()->get();
		return view('backend.settings.index')->withSettings($settings);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$setting = new Setting();
		return view('backend.settings.create')->withSetting($setting);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, Setting::$rules);

		$inputs = $request->all();
		Setting::create($inputs);
		return redirect()->route('admin.settings.index')->withFlashSuccess('Saved successfully');
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
		$setting = Setting::findOrFail($id);
		return view('backend.settings.edit')->withSetting($setting);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		Setting::$rules['skey'] .= ',id,' . $id;

		$this->validate($request, Setting::$rules);

		$inputs = $request->all();
		$setting = Setting::findOrFail($id);
		$setting->fill($inputs);
		$setting->save();
		return redirect()->route('admin.settings.index')->withFlashSuccess('Saved successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		Setting::destroy($id);
		return redirect()->route('admin.settings.index')->withFlashSuccess("Deleted successfully");
	}
}

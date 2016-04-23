<?php

use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settings', function ($table) {
			$table->increments('id');
			$table->string('skey');
			$table->string('name')->nullable();
			$table->text('value');
			$table->enum('type', ['System', 'Default', 'User']);
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('settings');
	}
}

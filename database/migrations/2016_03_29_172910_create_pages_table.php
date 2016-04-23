<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pages', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('permission', 100)->nullable();
			$table->boolean('status')->default(true);
			$table->enum('compiler', ['blade', 'html', 'none'])->default('none');
			$table->softDeletes();
		});

		Schema::create('page_translations', function ($table) {
			$table->increments('id');
			$table->integer('page_id')->unsigned();
			$table->string('locale')->index();

			$table->string('name');
			$table->string('slug', 255);
			$table->text('content');
			$table->text('keyword');
			$table->text('description');

			$table->unique(['page_id', 'locale']);
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('page_translations');
		Schema::drop('pages');
	}
}

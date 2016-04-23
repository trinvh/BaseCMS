<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menus', function (Blueprint $table) {

			$table->increments('id');
			$table->integer('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			$table->string('icon', 50)->nullable();
			$table->string('permission', 100)->nullable();

			$table->enum('open', ['New', 'Same'])->default('Same');
			$table->boolean('status')->default(true);
			$table->softDeletes();

			$table->timestamps();
		});

		Schema::create('menu_translations', function ($table) {
			$table->increments('id');
			$table->integer('menu_id')->unsigned();
			$table->string('locale')->index();

			$table->string('name');
			$table->text('description')->nullable();
			$table->string('url', 255);

			$table->unique(['menu_id', 'locale']);
			$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('menu_translations');
		Schema::drop('menus');
	}

}

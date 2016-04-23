<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('blog_categories', function (Blueprint $t) {
			$t->increments('id');
			$t->boolean('status')->default(true);
			$t->string('image')->nullable();
			$t->softDeletes();
			$t->timestamps();
		});

		Schema::create('blog_category_translations', function (Blueprint $t) {
			$t->increments('id');
			$t->string('name');
			$t->string('slug', 255);
			$t->string('description', 500)->nullable();

			$t->integer('blog_category_id')->unsigned();

			$t->string('locale')->index();
			$t->unique(['blog_category_id', 'locale']);

			$t->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('blog_category_translations');
		Schema::drop('blog_categories');
	}
}

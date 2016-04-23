<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('blogs', function ($t) {
			$t->increments('id');

			$t->boolean('private')->default(false);
			$t->boolean('status')->default(true);
			$t->string('image')->nullable();

			$t->integer('user_id')->unsigned();
			$t->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$t->softDeletes();
			$t->timestamps();
		});

		Schema::create('blog_translations', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->string('slug', 255);

			$t->longText('content');
			$t->string('description', 500)->nullable();

			$t->integer('blog_id')->unsigned();
			$t->string('locale')->index();
			$t->unique(['blog_id', 'locale']);

			$t->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
		});

		Schema::create('blog_tags', function ($t) {
			$t->integer('blog_id')->unsigned();
			$t->integer('tag_id')->unsigned();
			$t->primary(['blog_id', 'tag_id']);

			$t->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
			$t->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});

		Schema::create('blog_post_category', function ($t) {
			$t->integer('blog_id')->unsigned();
			$t->integer('blog_category_id')->unsigned();
			$t->primary(['blog_id', 'blog_category_id']);

			$t->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
			$t->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('blog_post_category');
		Schema::drop('blog_tags');
		Schema::drop('blog_translations');
		Schema::drop('blogs');
	}
}

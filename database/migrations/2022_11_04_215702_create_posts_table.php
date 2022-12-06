<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users');
			$table->foreignId('category_id')->constrained('categories');
			$table->string('title');
			$table->string('slug')->unique();
			$table->text('content');
			$table->string('image')->default('uploads/posts/default.png')->nullable();
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts');
	}
};

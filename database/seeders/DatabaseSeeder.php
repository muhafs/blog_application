<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Models\User::create([
			'name' => 'Muhamad Hafs',
			'email' => 'm@mail.id',
			'email_verified_at' => now(),
			'password' => bcrypt('password'),
			'remember_token' => str()->random(10),
		]);

		\App\Models\User::factory(10)->create();

		$categories = ['Web Programming', 'Personal', 'Video Games', 'Business'];
		foreach ($categories as $category) {
			\App\Models\Category::create([
				'name' => $category,
				'slug' => str($category)->slug('-')
			]);
		}

		\App\Models\Post::factory(20)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
	}
}

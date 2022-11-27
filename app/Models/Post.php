<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
	use HasFactory;

	protected $guarded = [];
	protected $with = ['category', 'user'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}

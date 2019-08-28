<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapPointer extends Model
{
    //
	protected $fillable = [
		"title",
		"content",
		"lng",
		"lat"
	];
}

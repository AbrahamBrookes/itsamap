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
		"lat",
		"map_id"
	];
	
	public function map(){
		return $this->belongsTo('\App\Map');
	}
	
	public function image(){
		return $this->hasOne('\App\Image');
	}
}

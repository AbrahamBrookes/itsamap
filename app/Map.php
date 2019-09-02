<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
	
	protected $fillable = [
		'name',
	];
	
    public function pointers(){
		return $this->hasMany('\App\MapPointer');
	}
}

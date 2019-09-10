<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
	
	protected $fillable = [
		'name',
		'published',
		'screenshot',
		'user_id'
	];
	
    public function pointers(){
		return $this->hasMany('\App\MapPointer');
	}
	
	public function user(){
		return $this->belongsTo('\App\User');
	}
	
	public function geojson(){
		
		$json = [
			"type"=>"FeatureCollection",
			"features"=>[]
		];
		
		foreach( $this->pointers as $pointer ){
			$json['features'][] = [ 
				"type" => "Feature",
				"properties" => [  
					"id" => $pointer->id,
					"title" => $pointer->title,
					"content" => $pointer->content,
					"handle" => $pointer->image->handle,
					"lng" => $pointer->lng,
					"lat" => $pointer->lat,
				],
				"geometry" => [
					"type" => "Point",
					"coordinates" => [  
						$pointer->lng,
						$pointer->lat
					]
				]
			
			];
		}
		
		return $json;
		
	}
	
}

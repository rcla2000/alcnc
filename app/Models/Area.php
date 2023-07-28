<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $table = 'c_areas';
	protected $primaryKey = 'id_area';
	public $timestamps = false;

	protected $casts = [
		'id_direccion_padre' => 'int',
		'area_padre' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'id_direccion_padre',
		'area_padre'
	];
}

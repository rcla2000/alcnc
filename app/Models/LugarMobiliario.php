<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LugarMobiliario extends Model
{
	protected $table = 'c_lugares_mobiliario';
	protected $primaryKey = 'id_lugar';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
	];

	public function solicitudes()
	{
		return $this->hasMany(TSolicitudesMobiliario::class, 'lugar_solicitado', 'id_lugar');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CServicio
 * 
 * @property int $id_servicio
 * @property string|null $des_servicio
 * @property string|null $icono
 * @property string|null $ruta
 * @property string|null $imgbg
 * @property int|null $id_area
 * 
 * @property CArea|null $c_area
 *
 * @package App\Models
 */
class CServicio extends Model
{
	protected $table = 'c_servicios';
	protected $primaryKey = 'id_servicio';
	public $timestamps = false;

	protected $casts = [
		'id_area' => 'int'
	];

	protected $fillable = [
		'des_servicio',
		'icono',
		'ruta',
		'imgbg',
		'id_area'
	];

	public function c_area()
	{
		return $this->belongsTo(CArea::class, 'id_area');
	}
}

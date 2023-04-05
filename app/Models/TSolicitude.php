<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TSolicitude
 * 
 * @property int $id_solicitud
 * @property string|null $desc_solicitud
 * @property int|null $area
 * @property int|null $direccion
 * @property Carbon|null $fecha_solicitud
 * @property Carbon|null $fecha_resolucion
 * @property string|null $estado_solicitud
 *
 * @package App\Models
 */
class TSolicitude extends Model
{
	protected $table = 't_solicitudes';
	protected $primaryKey = 'id_solicitud';
	public $timestamps = false;

	protected $casts = [
		'area' => 'int',
		'direccion' => 'int',
		'fecha_solicitud' => 'date',
		'fecha_resolucion' => 'date'
	];

	protected $fillable = [
		'desc_solicitud',
		'area',
		'direccion',
		'fecha_solicitud',
		'fecha_resolucion',
		'estado_solicitud'
	];
}

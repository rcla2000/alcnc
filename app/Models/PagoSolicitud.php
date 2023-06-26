<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PagosSolicitude
 * 
 * @property int $id
 * @property int $id_solicitud
 * @property int $id_area
 * @property int $id_direccion
 * @property int $cantidad
 * @property float $precio
 *
 * @package App\Models
 */
class PagoSolicitud extends Model
{
	protected $table = 'pagos_solicitudes';
	public $timestamps = false;

	protected $casts = [
		'id_solicitud' => 'int',
		'id_area' => 'int',
		'id_direccion' => 'int',
		'cantidad' => 'int',
		'precio' => 'float'
	];

	protected $fillable = [
		'id_solicitud',
		'id_area',
		'id_direccion',
		'cantidad',
		'precio'
	];
}

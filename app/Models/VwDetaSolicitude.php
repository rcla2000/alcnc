<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwDetaSolicitude
 * 
 * @property int $id
 * @property string $nombre
 * @property string $dui
 * @property string|null $solicitud
 * @property int|null $cantidad
 * @property int $autentica
 * @property string|null $comentario
 * @property Carbon|null $fecha_documento
 * @property Carbon $fecha_solicitud
 * @property Carbon|null $fecha_actualizacion
 * @property Carbon|null $fecha_resolucion
 * @property string $area
 * @property string $direccion
 * @property string|null $usuario_actualizacion
 *
 * @package App\Models
 */
class VwDetaSolicitude extends Model
{
	protected $table = 'vw_deta_solicitudes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'cantidad' => 'int',
		'autentica' => 'int',
		'fecha_documento' => 'date',
		'fecha_solicitud' => 'date',
		'fecha_actualizacion' => 'date',
		'fecha_resolucion' => 'date'
	];

	protected $fillable = [
		'id',
		'nombre',
		'dui',
		'solicitud',
		'cantidad',
		'autentica',
		'comentario',
		'fecha_documento',
		'fecha_solicitud',
		'fecha_actualizacion',
		'fecha_resolucion',
		'area',
		'direccion',
		'usuario_actualizacion'
	];
}

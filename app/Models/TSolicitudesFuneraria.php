<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TSolicitudesFuneraria
 * 
 * @property int $id_solicitud
 * @property string|null $usuario
 * @property string|null $solicitud
 * @property int|null $estado
 * @property string|null $usuario_actualizacion
 * @property Carbon|null $fecha_solicitud
 * @property Carbon|null $fecha_actualizacion
 *
 * @package App\Models
 */
class TSolicitudesFuneraria extends Model
{
	protected $table = 't_solicitudes_funerarias';
	protected $primaryKey = 'id_solicitud';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'int',
		'fecha_solicitud' => 'date',
		'fecha_actualizacion' => 'date'
	];

	protected $fillable = [
		'usuario',
		'solicitud',
		'estado',
		'usuario_actualizacion',
		'fecha_solicitud',
		'fecha_actualizacion'
	];

	public function estado_solicitud() {
		return $this->belongsTo(TEstadosSolicitude::class, 'estado', 'id_estado');
	}
}

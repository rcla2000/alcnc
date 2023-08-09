<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TSolicitudesMobiliario
 * 
 * @property int $id_solicitud
 * @property string|null $usuario
 * @property string|null $lugar_solicitado
 * @property Carbon|null $fecha_evento
 * @property int|null $sillas
 * @property int|null $mesas
 * @property int|null $canopis
 * @property int|null $estado
 * @property string|null $usuario_actualizacion
 * @property Carbon|null $fecha_solicitud
 * @property Carbon|null $fecha_actualizacion
 *
 * @package App\Models
 */
class TSolicitudesMobiliario extends Model
{
	protected $table = 't_solicitudes_mobiliario';
	protected $primaryKey = 'id_solicitud';
	public $timestamps = false;

	protected $casts = [
		'fecha_evento' => 'date',
		'sillas' => 'int',
		'mesas' => 'int',
		'canopis' => 'int',
		'estado' => 'int',
		'fecha_solicitud' => 'date',
		'fecha_actualizacion' => 'date'
	];

	protected $fillable = [
		'usuario',
		'lugar_solicitado',
		'fecha_evento',
		'sillas',
		'mesas',
		'canopis',
		'estado',
		'usuario_actualizacion',
		'fecha_solicitud',
		'fecha_actualizacion',
		'comentarios'
	];

	public function estado_solicitud() {
		return $this->belongsTo(TEstadosSolicitude::class, 'estado', 'id_estado');
	}

	public function lugar() {
		return $this->belongsTo(LugarMobiliario::class, 'lugar_solicitado', 'id_lugar');
	}
}

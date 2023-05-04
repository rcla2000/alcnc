<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TCitasClinica
 * 
 * @property int $id_cita
 * @property Carbon $fecha_cita
 * @property int $especialidad
 * @property int $id_usuario
 * @property string $estado_cita
 *
 * @package App\Models
 */
class TCitasClinica extends Model
{
	protected $table = 't_citas_clinica';
	protected $primaryKey = 'id_cita';
	public $timestamps = false;

	protected $casts = [
		'fecha_cita' => 'date',
		'especialidad' => 'int',
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'fecha_cita',
		'especialidad',
		'id_usuario',
		'estado_cita'
	];
}

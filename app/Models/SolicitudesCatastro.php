<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SolicitudesCatastro
 * 
 * @property int $id_solicitud
 * @property string|null $dui_solicitante
 * @property int|null $estado
 * @property Carbon|null $fecha_solicitud
 * @property Carbon|null $fecha_actualizacion
 * @property Carbon|null $fecha_resolucion
 * @property int|null $usuario_actualizacion
 * 
 * @property CatastroEstado|null $catastro_estado
 *
 * @package App\Models
 */
class SolicitudesCatastro extends Model
{
	protected $table = 'solicitudes_catastro';
	protected $primaryKey = 'id_solicitud';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'int',
		'fecha_solicitud' => 'date',
		'fecha_actualizacion' => 'date',
		'fecha_resolucion' => 'date',
		'usuario_actualizacion' => 'int'
	];

	protected $fillable = [
		'dui_solicitante',
		'estado',
		'fecha_solicitud',
		'fecha_actualizacion',
		'fecha_resolucion',
		'usuario_actualizacion'
	];

	public function catastro_estado()
	{
		return $this->belongsTo(CatastroEstado::class, 'estado');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TSolicitude
 * 
 * @property int $id_solicitud
 * @property string|null $dui_solicitante
 * @property int|null $tipo_solicitud
 * @property int|null $cantidad
 * @property string|null $nombre_documento
 * @property Carbon|null $fecha_documento
 * @property int|null $autentica
 * @property string|null $desc_solicitud
 * @property float|null $monto_solicitud
 * @property float|null $porc_fiesta
 * @property Carbon $fecha_solicitud
 * @property Carbon|null $fecha_resolucion
 * @property Carbon|null $observacion
 * @property int|null $estado_solicitud
 * @property string|null $usuario_actualizacion
 * @property Carbon|null $fecha_actualizacion
 * 
 * @property TEstadosSolicitude|null $t_estados_solicitude
 * @property CatTipoSolicitude|null $cat_tipo_solicitude
 * @property Collection|TBitSolicitud[] $t_bit_solicituds
 *
 * @package App\Models
 */
class TSolicitude extends Model
{
	protected $table = 't_solicitudes';
	protected $primaryKey = 'id_solicitud';
	public $timestamps = false;

	protected $casts = [
		'tipo_solicitud' => 'int',
		'cantidad' => 'int',
		'fecha_documento' => 'date',
		'autentica' => 'int',
		'porc_fiesta' => 'float',
		'fecha_solicitud' => 'date',
		'fecha_resolucion' => 'date',
		'observacion' => 'date',
		'estado_solicitud' => 'int',
		'fecha_actualizacion' => 'date'
	];

	protected $fillable = [
		'dui_solicitante',
		'tipo_solicitud',
		'cantidad',
		'nombre_documento',
		'fecha_documento',
		'autentica',
		'desc_solicitud',
		'porc_fiesta',
		'fecha_solicitud',
		'fecha_resolucion',
		'observacion',
		'estado_solicitud',
		'usuario_actualizacion',
		'fecha_actualizacion'
	];

	public function t_estados_solicitude()
	{
		return $this->belongsTo(TEstadosSolicitude::class, 'estado_solicitud');
	}

	public function cat_tipo_solicitud()
	{
		return $this->belongsTo(CatTipoSolicitude::class, 'tipo_solicitud', 'id_t_solicitud');
	}

	public function t_bit_solicituds()
	{
		return $this->hasMany(TBitSolicitud::class, 'solicitud');
	}
}

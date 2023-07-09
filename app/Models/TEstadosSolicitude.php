<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TEstadosSolicitude
 * 
 * @property int $id_estado
 * @property string|null $desc_estado
 * 
 * @property Collection|TBitSolicitud[] $t_bit_solicituds
 * @property Collection|TSolicitude[] $t_solicitudes
 *
 * @package App\Models
 */
class TEstadosSolicitude extends Model
{
	protected $table = 't_estados_solicitudes';
	protected $primaryKey = 'id_estado';
	public $timestamps = false;

	protected $fillable = [
		'desc_estado'
	];

	public function t_bit_solicituds()
	{
		return $this->hasMany(TBitSolicitud::class, 'estado');
	}

	public function t_solicitudes()
	{
		return $this->hasMany(TSolicitude::class, 'estado_solicitud', 'id_estado');
	}
}

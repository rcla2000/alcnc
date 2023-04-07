<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwSolicitude
 * 
 * @property int $id_t_solicitud
 * @property string|null $desc_solicitud
 *
 * @package App\Models
 */
class VwSolicitude extends Model
{
	protected $table = 'vw_solicitudes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_t_solicitud' => 'int'
	];

	protected $fillable = [
		'id_t_solicitud',
		'desc_solicitud'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CEspecialidadesClinica
 * 
 * @property int $id_especialidad
 * @property string|null $des_especialidad
 * @property int|null $cupo_max
 * @property Carbon|null $create_at
 *
 * @package App\Models
 */
class CEspecialidadesClinica extends Model
{
	protected $table = 'c_especialidades_clinica';
	protected $primaryKey = 'id_especialidad';
	public $timestamps = false;

	protected $casts = [
		'cupo_max' => 'int',
		'create_at' => 'date'
	];

	protected $fillable = [
		'des_especialidad',
		'cupo_max',
		'create_at'
	];
}

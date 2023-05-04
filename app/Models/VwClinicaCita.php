<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwClinicaCita
 * 
 * @property string|null $especialidad
 * @property Carbon $fecha_cita
 * @property int $citas
 *
 * @package App\Models
 */
class VwClinicaCita extends Model
{
	protected $table = 'vw_clinica_citas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'fecha_cita' => 'date',
		'citas' => 'int'
	];

	protected $fillable = [
		'especialidad',
		'fecha_cita',
		'citas'
	];
}

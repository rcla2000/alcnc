<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CatTipoSolicitude
 * 
 * @property int $id_t_solicitud
 * @property string|null $desc_solicitud
 * @property int|null $id_area
 * @property Carbon|null $fecha_creacion
 * 
 * @property CArea|null $c_area
 *
 * @package App\Models
 */
class CatTipoSolicitude extends Model
{
	protected $table = 'cat_tipo_solicitudes';
	protected $primaryKey = 'id_t_solicitud';
	public $timestamps = false;

	protected $casts = [
		'id_area' => 'int',
		'fecha_creacion' => 'date',
		'id_arancel' => 'int'
	];

	protected $fillable = [
		'desc_solicitud',
		'id_area',
		'id_arancel',
		'fecha_creacion'
	];

	public function c_area()
	{
		return $this->belongsTo(CArea::class, 'id_area');
	}

	public function solicitudes() {
		return $this->hasMany(TSolicitude::class, 'tipo_solicitud', 'id_t_solicitud');
	}

	public function arancel()
	{
		return $this->belongsTo(CArancele::class, 'id_arancel', 'id_arancel');
	}
}

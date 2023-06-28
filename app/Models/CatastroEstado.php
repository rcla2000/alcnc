<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CatastroEstado
 * 
 * @property int $id_estado
 * @property string $estado
 * 
 * @property Collection|SolicitudesCatastro[] $solicitudes_catastros
 *
 * @package App\Models
 */
class CatastroEstado extends Model
{
	protected $table = 'catastro_estados';
	protected $primaryKey = 'id_estado';
	public $timestamps = false;

	protected $fillable = [
		'estado'
	];

	public function solicitudes_catastros()
	{
		return $this->hasMany(SolicitudesCatastro::class, 'estado');
	}
}

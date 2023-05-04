<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CArancele
 * 
 * @property int $id_arancel
 * @property string|null $desc_arancel
 * @property float|null $precio
 * @property float|null $porcentaje
 * 
 * @property Collection|CatTipoSolicitude[] $cat_tipo_solicitudes
 *
 * @package App\Models
 */
class CArancele extends Model
{
	protected $table = 'c_aranceles';
	protected $primaryKey = 'id_arancel';
	public $timestamps = false;

	protected $casts = [
		'precio' => 'float',
		'porcentaje' => 'float'
	];

	protected $fillable = [
		'desc_arancel',
		'precio',
		'porcentaje'
	];

	public function cat_tipo_solicitudes()
	{
		return $this->hasMany(CatTipoSolicitude::class, 'id_arancel');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwCargo
 * 
 * @property int $id
 * @property string|null $impuesto
 * @property int|null $cantidad
 * @property float|null $precio
 * @property float|null $subtotal
 *
 * @package App\Models
 */
class VwCargo extends Model
{
	protected $table = 'vw_cargos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'cantidad' => 'int',
		'precio' => 'float',
		'subtotal' => 'float'
	];

	protected $fillable = [
		'id',
		'impuesto',
		'cantidad',
		'precio',
		'subtotal'
	];
}

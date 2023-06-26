<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensaje
 * 
 * @property int $id
 * @property string $nombre
 * @property string $telefono
 * @property string $mensaje
 *
 * @package App\Models
 */
class Mensaje extends Model
{
	protected $table = 'mensajes';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'telefono',
		'mensaje'
	];
}

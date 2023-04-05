<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TDenuncia
 * 
 * @property int $id_denuncia
 * @property string|null $nombre
 * @property string|null $telefono
 * @property int|null $id_asunto
 * @property string|null $mensaje
 * @property Carbon $fecha
 *
 * @package App\Models
 */
class TDenuncia extends Model
{
	protected $table = 't_denuncias';
	protected $primaryKey = 'id_denuncia';
	public $timestamps = false;

	protected $casts = [
		'id_asunto' => 'int',
		'fecha' => 'date'
	];

	protected $fillable = [
		'nombre',
		'telefono',
		'id_asunto',
		'mensaje',
		'fecha'
	];
}

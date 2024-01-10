<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
	use HasFactory;
	use SoftDeletes;
	/**
	 * The table associated with the model.
	 * 
	 * @var string
	 */
	protected $table = 'logger';

	/**
	 * The "type" of the auto-incrementing ID.
	 * 
	 * @var string
	 */
	protected $keyType = 'integer';

	/**
	 * @var array
	 */
	protected $fillable = ['id_usuario', 'ip', 'operacion', 'parametros'];
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    //
    protected $fillable = [
    	'nome',
    	'descricao',
    	'dt_inicio',
    	'status_id',
    	'situacao'
    ]
}

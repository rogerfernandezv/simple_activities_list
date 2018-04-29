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
    	'dt_fim',
    	'status_id',
    	'situacao'
    ];

    public function status_synonym(){
    	return $this->hasOne('App\Status', 'id', 'status_id');
    }
}

<?php

namespace App;
use Illuminate\Support\Facades\DB;

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

    public function status_display_name(){
    	return Db::select('call status_synonym(?, @a)', array($this->attributes['status_id']))[0]->display_name;
    }

    /*public function status_display_name($id){
    	return Db::select('call status_synonym(?, @a)', array($id))[0]->display_name;
    }*/
}

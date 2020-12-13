<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlTag extends Model
{
    protected $table = 'control_favoritos';
    protected $fillable = ['id_user', 
                           'nome',
                           'language',
                           'image'
                          ];


    public function relUser() {
        return $this->hasOne('App\User', 'id', 'id_user' );
    }
} 

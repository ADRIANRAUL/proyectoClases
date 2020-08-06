<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //relación inversa de varios a uno
    public function user(){
        return $this->belongsTo('App\User');
    }

/*     public function isAdmin(){
        $isAdmin = $this->whereHas('roles', function($query){
            $query->where('description','Administrador');
        })->count();

        return $isAdmin == 1;
    } */
}

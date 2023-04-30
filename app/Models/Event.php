<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    Public function Workshops(){
        return $this->hasMany('App\Models\Workshop');
    }

    Public function FutureEvents(){
        return $this->hasOne('App\Models\Workshop')->orderBy('id','asc');
    }
}

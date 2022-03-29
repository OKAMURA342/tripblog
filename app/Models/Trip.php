<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded=array('id');
    protected $table = 'trip';

    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function good() {
        return $this->hasMany('App\Models\Good');
    }

    public function comments(){
    return $this->hasMany('App\Models\Comment');
    }
}


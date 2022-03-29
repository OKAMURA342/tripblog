<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = [
        'comment',
        'trip_id',
        'name_id',
    ];
    public function trip()
    {
        return $this->belongsTo(('App\Models\Trip'));
    }

    public function user()
    {
        return $this->belongsTo(('App\Models\User'));
    }

     
}

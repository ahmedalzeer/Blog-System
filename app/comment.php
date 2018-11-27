<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'c_content','post_id','user_id'
    ];
    public function post()
    {
        return $this->belongsTo('App\Post','post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}

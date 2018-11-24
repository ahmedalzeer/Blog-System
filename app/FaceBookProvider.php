<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaceBookProvider extends Model
{
    protected $fillable =[
        'provider_id','provider'
    ];
    /**
     * FaceBook Provider relation.
     *
     * @relation function
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}

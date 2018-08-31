<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyServiceProvider extends Model
{
    protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo('App\Serviceprovider', 'user_id');
    }
}

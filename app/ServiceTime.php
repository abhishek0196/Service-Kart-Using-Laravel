<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTime extends Model
{
    //
    protected $fillable = ['serviceproviders_id', 'start_time', 'end_time', 'Day'];

    protected $table = 'service_times';

}
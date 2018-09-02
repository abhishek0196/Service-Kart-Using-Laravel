<?php

namespace App;

use App\Notifications\ServiceproviderResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Serviceprovider extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_no','google_code','verified',//,'days_of_week',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ServiceproviderResetPassword($token));
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    
    public function verifyUser()
    {
      return $this->hasOne('App\VerifyServiceProvider');
    }
}
        
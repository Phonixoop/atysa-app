<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'mobile',
        'companyId', 'activationKey', 'plan', 'isVip',
        'dessert', 'calory', 'avatar', 'guest'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'manager');
    }
    public static function updateUserPlan($plates, $id)
    {
        $plans = array();
        $User = User::find($id);
        foreach ($plates as $date => $row) {
            if ($row != null) {
                $plans[$date] = $row;
            }
        }
        $User->update(['plan' => $plans]);
    }
}

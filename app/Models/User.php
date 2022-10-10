<?php

namespace App\Models;

use Carbon\Carbon;
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
        $user = User::find($id);
        $userJson = $user->jsonserialize();

        foreach ($plates as $date => $row) {
            // $userJson["plan"][$date] = $row;
            $userJson["plan"][$date] = $row;
        }
        // array_push($userJson["plan"], $plans);
        // dd(json_encode($userJson, JSON_PRETTY_PRINT));
        $user->fill($userJson);
        $user->save();
    }
    public static function getPlansCount($id)
    {
        $user = User::find($id);
        $counter = 0;
        $today = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::now())->format("d");
        foreach ($user->plan as $date => $plateId) {
            $rowDay = \Morilog\Jalali\Jalalian::fromCarbon(Carbon::createFromFormat('Y-m-d', $date))->format('d');

            if ($plateId == null || $rowDay < $today)
                continue;
            $counter++;
        }

        return $counter;
    }
    public static function getPlans($plates, $id)
    {
        dd($plates);
        $plates = array();
        foreach ($plates as $date => $row) {
            $plate = Plate::find($row)->toArray();
        }
    }
}

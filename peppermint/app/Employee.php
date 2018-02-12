<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Employee extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'sin',
        'phone_number',
        'address',
        'wage',
        'hours',
        'firm_id',
        'user_id'
    ];


    public function getHoursMonth($id){
        $hours = 0;
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $events = DB::table('events')
            ->where('employee_id', '=', $id)
            ->whereDate('punched_in', '>', $start)
            ->whereDate('punched_out', '<', $end)
            ->get();

        foreach ($events as $event) {
            $tempS = null;
            $tempE = null;
            foreach ($event as $key => $value) {
                if($key == 'punched_in')
                    $tempS = new Carbon($value);
                if($key == 'punched_out')
                    $tempE = new Carbon($value);
            }

            $hours += ($tempE->timestamp) - ($tempS->timestamp);
        }


        return round(($hours/60)/60, 2);
    }

    public function geHoursPerDayForMonth($id){
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $events = DB::table('events')
            ->where('employee_id', '=', $id)
            ->whereDate('punched_in', '>', $start)
            ->whereDate('punched_out', '<', $end)
            ->orderBy('start', 'asc')
            ->get();

        $days = [];
        $hours = [];

        foreach ($events as $event) {
            $tempS = null;
            $tempE = null;
            foreach ($event as $key => $value) {
                if($key == 'punched_in')
                    $tempS = new Carbon($value);
                if($key == 'punched_out')
                    $tempE = new Carbon($value);
            }
            $tempHours = ($tempE->timestamp) - ($tempS->timestamp);
            $tempHours = ($tempHours/60)/60;

            array_push($hours, round($tempHours, 2));
            array_push($days, $tempS->toDateString());
        }

        $data = [
            'days' => $days,
            'hours' => $hours
        ];

        return $data;

    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function firm(){
        return $this->belongsTo(Firm::class, 'id');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function createUser($email, $password){
        $user = new User;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        $user->roles()->attach(3);

        return $user->id;
    }
}

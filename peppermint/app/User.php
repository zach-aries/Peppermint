<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
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
     * Sets the user->role relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * Checks to see if a user has a particular role
     *
     * @param $name - string
     * @return bool
     */
    public function hasRole($name){
        foreach($this->roles as $role){
            if($role->name == $name)
                return true;
            else
                return false;
        }
    }

    /**
     * Set the role of user
     *
     * @param $role - int
     */
    public function setRole($role){
        $this->roles()->attach($role);
    }

    public function removeRole($role){
        $this->roles()->detach($role);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Defines the relationship between Firm and Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner(){
        return $this->belongsTo(Admin::class);
    }


    /**
     * Defines the relationship between Firm and Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employee(){
        return $this->hasMany(Employee::class);
    }

    /**
     * Defines firm -> supplies relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplies(){
        return $this->hasMany(Supplies::class);
    }

    /**
     * Defines firm -> invoices relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}

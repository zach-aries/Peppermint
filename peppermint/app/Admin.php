<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * Used for databse seeding
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'user_id',
        'name',
        'billing_info',
    ];

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(Admin::class, 'id');
    }

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo(Firm::class, 'id');
    }

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
}

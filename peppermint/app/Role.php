<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * used for db seeding
     * @var array
     */
    protected $fillable =['name'];
}

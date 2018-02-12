<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firm(){
        return $this->belongsTo(Firm::class, 'id');
    }
}

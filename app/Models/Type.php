<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable = ['type'];

    public function works(): hasMany {
        return $this->hasMany(Work::class);
    }
}

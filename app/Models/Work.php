<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
    protected $fillable = ['title', 'cover', 'summary'];

    public function book(): HasMany {
        return $this->hasMany(Book::class);
    }
}

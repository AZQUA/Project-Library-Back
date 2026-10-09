<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
    protected $fillable = ['title', 'cover', 'summary'];

    public function editions(): BelongsToMany {
        return $this->BelongsToMany(Edition::class);
    }

    public function types(): BelongsToMany {
        return $this->BelongsToMany(Type::class);
    }

    public function authors(): BelongsToMany {
        return $this->BelongsToMany(Author::class);
    }
}

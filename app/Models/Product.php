<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function options(): HasMany{
        return $this->hasMany(Options::class);
    }
    public function prices(): HasMany{
        return $this->hasMany(Prices::class);
    }
    public function tags(): HasMany{
        return $this->hasMany(Tags::class);
    }
}

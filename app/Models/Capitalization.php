<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitalization extends Model
{
    /** @use HasFactory<\Database\Factories\CapitalizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}

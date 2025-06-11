<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}

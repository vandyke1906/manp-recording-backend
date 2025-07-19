<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantType extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'applicant_type_applications');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationFiles extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFilesFactory> */
    use HasFactory;

    protected $fillable = [
        'application_id',
        'name',
        'file_type',
        'file_size',
        'file_name',
        'file_path',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}

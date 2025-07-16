<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'application_date',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email_address',
        'contact_number',
        'address',
        'application_type_id',
        'application_number',
        'user_id',
        'business_name',
        'business_address',
        'business_description',
        'business_nature_id',
        'business_status_id',
        'capitalization_id',
        'business_type_id',
        'zoning_id',
    ];

    protected $appends = ['current_approver_role'];

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'application_id');
    }

    public function getCurrentApproverRoleAttribute()
    {
        return $this->approvals()
            ->where('status', 'pending')
            ->orderBy('created_at') // or use another sequencing strategy
            ->value('approving_role'); // make sure this is the correct column
    }

    public function files()
    {
        return $this->hasMany(ApplicationFiles::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function application_type()
    {
        return $this->belongsTo(ApplicationType::class, 'application_type_id');
    }
    

}

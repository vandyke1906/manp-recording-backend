<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use App\Policies\ApplicationPolicy;

#[UsePolicy(ApplicationPolicy::class)]
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

    protected $appends = ['current_approver_role', 'full_name'];

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

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} " . 
            ($this->middle_name ? strtoupper(substr($this->middle_name, 0, 1)) . ". " : '') . 
            "{$this->last_name} " . 
            ($this->suffix ?? ''));
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

    public function capitalization()
    {
        return $this->belongsTo(Capitalization::class, 'capitalization_id');
    }

    public function business_nature()
    {
        return $this->belongsTo(BusinessNature::class, 'business_nature_id');
    }
    
    public function business_status()
    {
        return $this->belongsTo(BusinessStatus::class, 'business_status_id');
    }

    public function applicant_types()
    {
        return $this->belongsToMany(ApplicantType::class, 'applicant_type_applications');
    }
    

}

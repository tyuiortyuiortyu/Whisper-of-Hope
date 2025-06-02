<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HairRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'recipient_full_name',
        'recipient_age',
        'recipient_email',
        'recipient_phone',
        'recipient_reason',
        'requester_full_name',
        'requester_email',
        'requester_phone',
        'relationship_to_recipient',
        'healthcare_location',
        'user_id',
        'purpose_id',
    ];

    protected $casts = [
        'role' => 'string',
        'recipient_age' => 'integer',
    ];

    /**
     * Define the available roles
     */
    public const ROLES = [
        'medical_professional' => 'Medical Professional',
        'parent_guardian' => 'Parent/Guardian',
        'myself' => 'Myself',
    ];

    /**
     * Get the user who created this request
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the purpose of this request
     */
    public function purpose(): BelongsTo
    {
        return $this->belongsTo(Purpose::class);
    }

    /**
     * Check if the request is for the requester themselves
     */
    public function isForSelf(): bool
    {
        return $this->role === 'myself';
    }

    /**
     * Check if the request is from a medical professional
     */
    public function isMedicalProfessional(): bool
    {
        return $this->role === 'medical_professional';
    }

    /**
     * Check if the request is from a parent/guardian
     */
    public function isParentGuardian(): bool
    {
        return $this->role === 'parent_guardian';
    }

    /**
     * Get the primary contact email
     */
    public function getPrimaryEmailAttribute(): string
    {
        if ($this->isForSelf()) {
            return $this->recipient_email ?? $this->user->email;
        }
        
        return $this->requester_email ?? $this->user->email;
    }

    /**
     * Get the primary contact phone
     */
    public function getPrimaryPhoneAttribute(): string
    {
        if ($this->isForSelf()) {
            return $this->recipient_phone ?? $this->user->phone;
        }
        
        return $this->requester_phone ?? $this->user->phone;
    }

    /**
     * Get the display name for the role
     */
    public function getRoleDisplayAttribute(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}

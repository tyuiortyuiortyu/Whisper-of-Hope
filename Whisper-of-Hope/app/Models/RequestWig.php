<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestWig extends Model
{
    use HasFactory;
    // protected $table = 'hair_requests';

    protected $fillable = [
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
        'recipient_age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function isForParentGuardian()
    {
        return $this->relationship_to_recipient === 'parent_guardian';
    }
}

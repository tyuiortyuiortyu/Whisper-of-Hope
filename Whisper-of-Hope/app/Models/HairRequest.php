<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HairRequest extends Model
{
    use HasFactory;

    protected $table = 'hair_requests';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'who_for',
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
        'status',
    ];

    protected $casts = [
        'recipient_age' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($hairRequest) {
            if (empty($hairRequest->id)) {
                $count = self::count();
                $nextId = $count + 1;
                $formattedId = str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $hairRequest->id = 'WR' . $formattedId;
            }
        });
    }

    /**
     * Get the user who created this request
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

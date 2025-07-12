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
                $latestRequest = self::query()->orderByRaw('CAST(SUBSTRING(id, 3) AS UNSIGNED) DESC')->first();

                $nextIdNumber = 1; // Start at 1 if this is the first record.
                
                if ($latestRequest) {
                    $lastIdNumber = (int) substr($latestRequest->id, 2);
                    $nextIdNumber = $lastIdNumber + 1;
                }

                $hairRequest->id = 'WR' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);
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

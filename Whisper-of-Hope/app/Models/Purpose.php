<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purpose extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all hair requests with this purpose
     */
    public function hairRequests(): HasMany
    {
        return $this->hasMany(HairRequest::class);
    }
}

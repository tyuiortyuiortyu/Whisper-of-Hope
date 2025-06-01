<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Whisper extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'to',
        'content',
        'color_id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    // Order by newest first by default
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('ordered', function ($builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}

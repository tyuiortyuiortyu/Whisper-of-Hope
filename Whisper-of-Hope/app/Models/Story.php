<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'title',
        'image',
        'content',
        'category_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

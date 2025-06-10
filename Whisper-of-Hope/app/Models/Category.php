<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Jika tidak ingin kolom selain yang disebutkan bisa diisi massal
    protected $fillable = [
        'name',
    ];

    // Relasi: satu category bisa punya banyak stories
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}

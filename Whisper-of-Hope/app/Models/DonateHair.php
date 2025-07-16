<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonateHair extends Model
{
    use HasFactory;

    protected $table = 'hair_donations'; // Pastikan nama tabel sudah benar

    protected $primaryKey = 'id'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'id',
        'user_id',
        'full_name',
        'age',
        'email',
        'phone',
        'hair_length',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
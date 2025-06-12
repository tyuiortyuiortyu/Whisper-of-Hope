<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonateHair extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_name',
        'recipient_age',
        'recipient_email',
        'recipient_phone',
        'recipient_reason',
    ];
}


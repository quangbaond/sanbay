<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'payment_method',
        'description',
        'user_bank_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userBank()
    {
        return $this->belongsTo(UserBank::class);
    }
}

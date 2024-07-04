<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_account_name',
        'bank_branch',
        'bank_account',
        'bank_name',
        'id_card',
        'status',
    ];
}

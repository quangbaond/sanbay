<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'category_id',
        'name',
        'image',
        'profit_everyday',
        'time_invest',
        'progress',
        'amount_total',
        'amount_invested',
        'description',
        'min_invest',
        'times_invest_decision',
        'book_invest',
        'security',
        'sort_description',
        'interest_risk',
        'profit_calculation',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

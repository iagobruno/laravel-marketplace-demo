<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Product extends Model
{
    use Uuid;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'price',
        'user_id',
        'buyer_id',
        'bought_at'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

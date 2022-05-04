<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Jamesh\Uuid\HasUuid;

class Product extends Model
{
    use HasUuid;
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'price',
        'discount',
        'condition',
        'size',
        'seller_id',
        'buyer_id',
        'bought_at'
    ];

    protected $hidden = [];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     */
    public function scopeAvailable($query)
    {
        return $query->whereNull('bought_at');
    }

    public function calcApplicationFee()
    {
        $percent = 20;
        return $this->price / 100 * $percent;
    }

    public function calcSellerAmount()
    {
        return $this->price - $this->calcApplicationFee();
    }

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for implict binding.
     * @see https://laravel.com/docs/8.x/routing#implicit-binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

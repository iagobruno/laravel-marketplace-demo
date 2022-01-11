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
        'user_id',
        'buyer_id',
        'bought_at'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'R$ ' . number_format($this->price / 100, 2, ',', '.');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     */
    public function scopeAvailable($query)
    {
        return $query->whereNull('bought_at');
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
}

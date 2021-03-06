<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\StripeMethods;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use StripeMethods;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_seller',
        'stripe_customer_id',
        'stripe_account_id',
        'stripe_payment_method_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'stripe_customer_id',
        'stripe_account_id',
        'stripe_payment_method_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Product::class, 'buyer_id');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

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
        'name',
        'email',
        'password',
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
}

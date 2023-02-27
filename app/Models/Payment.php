<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'barcode',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($payment){
            $codebar = random_int(100, 999);
            $codebar .= time();

            $payment->barcode = $codebar;
        });
    }
}

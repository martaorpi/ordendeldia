<?php

namespace App\Models;

class EnrollmentOrder extends Order
{

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($order){
            $order->expiration_at = date("Y-m-d H:i:s" ,strtotime(date("Y-m-d H:i:s")."+ 1 days"));
            $order->type = EnrollmentOrder::class;
        });
    }
}

<?php

namespace App\Models;

class MonthlyOrder extends Order
{
    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($order){
            $order->expiration_at = date("Y-m-d H:i:s" ,strtotime(date("Y-m-d H:i:s")."+ 30 days"));
            $order->type = MonthlyOrder::class;
        });
    }
}

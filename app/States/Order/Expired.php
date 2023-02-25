<?php
namespace App\States\Order;
class Expired extends OrderState
{
    public function color(): string
    {
        return 'danger';
    }

    public function name(): string
    {
        return 'Expirado';
    }
}
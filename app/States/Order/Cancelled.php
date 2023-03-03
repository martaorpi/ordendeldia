<?php
namespace App\States\Order;
class Cancelled extends OrderState
{
    public function color(): string
    {
        return 'danger';
    }

    public function name(): string
    {
        return 'Cancelado';
    }
}
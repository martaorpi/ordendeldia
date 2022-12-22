<?php

namespace App\States\Order;
class Paid extends OrderState
{
    public function color(): string
    {
        return 'green';
    }
}
<?php

namespace App\States\Order;

class Pending extends OrderState
{
    public function color(): string
    {
        return 'green';
    }
}
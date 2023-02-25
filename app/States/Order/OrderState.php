<?php

namespace App\States\Order;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

use App\States\Order\Cancelled;
use App\States\Order\Pending;
use App\States\Order\Paid;
use App\States\Order\Expired;

abstract class OrderState extends State
{
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Paid::class)
            ->allowTransition(Pending::class, Cancelled::class)
            ->allowTransition(Pending::class, Expired::class)
        ;
    }
}
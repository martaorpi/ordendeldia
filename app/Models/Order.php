<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;
use App\States\Order\OrderState;

class Order extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasStates;

    protected $fillable = [
        'student_id',
        'tariff_account_id',
        'state',
        'amount',
    ];

    protected $casts = [
        'state' => OrderState::class,
    ];
}
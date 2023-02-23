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
        'description',
        'state',
        'amount',
        'payment_id',
        'payment_type',
    ];

    protected $casts = [
        'state' => OrderState::class,
    ];

    public function tariff_category()
    {
        return $this->belongsTo(\App\Models\TariffCategory::class, 'tariff_account_id');
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }
}
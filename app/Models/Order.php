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

    protected $table = 'orders';
    
    protected $fillable = [
        'student_id',
        'description',
        'state',
        'amount',
        'payment_id',
        'payment_type',
        'type',
        'expiration_at',
    ];

    public function scopeMonthly($query)
    {
        return $query->where('type', MonthlyOrder::class);
    }

    public function scopeEnrollment($query)
    {
        return $query->where('type', EnrollmentOrder::class);
    }

    public function scopeExtra($query)
    {
        return $query->where('type', Extra::class);
    }

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
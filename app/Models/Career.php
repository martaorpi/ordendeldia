<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TariffCategory;

class Career extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'short_name',
        'amount',
        'available_space',
        'ws_id',
        'duration',
        'status',
        'slug',
        'month_1',
        'month_2',
        'month_3',
        'month_4',
        'month_5',
        'month_6',
        'month_7',
        'month_8',
        'month_9',
        'month_10',
        'month_11',
        'month_12',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function getStudentTuitionAttribut(){
        return 200;
    }

    public function getEntrantTuitionAttribut(){
        return TariffCategory::where('reference_id', $this->id)
            ->where('model', $this)
            ->where('type', 'Matrícula')
            ->pluck('amount')->latest()->take(1)->first();
    }

    public function getDutyAttribut(){
        return 200;
    }
    
    protected $casts = [
        'id' => 'integer',
    ];

    public function students_with_space()
    {
        return $this->hasMany(\App\Models\Student::class)->whereIn('status', ['Inscripto'])->where('cycle_id', 2);
    }

    public function students_with_spaceA()
    {
        return $this->hasMany(\App\Models\Student::class)->whereIn('status', ['Aprobado'])->where('cycle_id', 2);
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }
}

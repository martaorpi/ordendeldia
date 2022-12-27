<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return 200;
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

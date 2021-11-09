<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'career_id',
        'cycle_id',
        'nationality_id',
        'province_id',
        'location_id',
        'location_description',
        'last_name',
        'first_name',
        'dni',
        'year_income',
        'address_district',
        'address_street',
        'address_number',
        'address_flat',
        'address_departament',
        'address_cp',
        'status',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'career_id' => 'integer',
        'cycle_id' => 'integer',
        'nationality_id' => 'integer',
        'province_id' => 'integer',
        'departament_id' => 'integer',
        'location_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function career()
    {
        return $this->belongsTo(\App\Models\Career::class);
    }

    public function cycle()
    {
        return $this->belongsTo(\App\Models\Cycle::class);
    }

    public function nacionality()
    {
        return $this->belongsTo(\App\Models\Nacionality::class);
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class);
    }

    public function departament()
    {
        return $this->belongsTo(\App\Models\Departament::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function documentation()
    {
        return $this->belongsTo(\App\Models\Documentation::class);
    }

    public function nationality()
    {
        return $this->belongsTo(\App\Models\Nationality::class);
    }

    public function exams()
    {
        return $this->belongsToMany(\App\Models\Exam::class);
    }
}

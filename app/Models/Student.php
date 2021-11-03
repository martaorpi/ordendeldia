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
        'nationality_id' => 'integer',
        'province_id' => 'integer',
        'location_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\Models\User::class);
    }

    public function career()
    {
        return $this->belongsTo(\App\Models\Models\Career::class);
    }

    public function nacionality()
    {
        return $this->belongsTo(\App\Models\Models\Nacionality::class);
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Models\Province::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\Models\Models\Location::class);
    }

    public function documentation()
    {
        return $this->belongsTo(\App\Models\Models\Documentation::class);
    }

    public function nationality()
    {
        return $this->belongsTo(\App\Models\Models\Nationality::class);
    }

    public function exams()
    {
        return $this->belongsToMany(\App\Models\Models\Exam::class);
    }
}

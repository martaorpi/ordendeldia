<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Student extends Model implements Auditable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes, HasSlug;
    use \OwenIt\Auditing\Auditable;

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
        'province_legal_id',
        'department_id',
        'department_legal_id',
        'location_id',
        'location_legal_id',
        'location_description',
        'last_name',
        'first_name',
        'dni',
        'year_income',
        'address',
        'address_legal',
        'address_street',
        'address_number',
        'address_flat',
        'address_departament',
        'address_cp',
        'date_birth',
        'landline',
        'cell_phone',
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
        'province_legal_id' => 'integer',
        'department_id' => 'integer',
        'department_legal_id' => 'integer',
        'location_id' => 'integer',
        'location_legal_id' => 'integer',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('last_name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }


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

    public function nationality()
    {
        return $this->belongsTo(\App\Models\Nationality::class);
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }

    public function documentation()
    {
        return $this->hasMany(\App\Models\Documentation::class);
    }

    public function exams()
    {
        return $this->belongsToMany(\App\Models\Exam::class);
    }
    
    public function log()
    {
        return $this->hasMany(\App\Models\Log::class);
    }
    public function message()
    {
        return $this->hasMany(\App\Models\Log::class)->where('type', 'Observacion enviada');
    }
}

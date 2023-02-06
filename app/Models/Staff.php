<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'staff';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class);
    }
    public function job()
    {
        return $this->belongsTo(\App\Models\Job::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(\App\Models\Subject::class, 'staff_subjects')->withPivot('staff_id','start_date','end_date','job_id','weekly_hours','plant_type','end_date','resolution_number');
    }
    /*public function subjects2()
    {
        return $this->belongsTo(\App\Models\StaffSubject::class);
    }*/
    public function licenses()
    {
        return $this->belongsToMany(\App\Models\License::class, 'staff_licenses')->withPivot('staff_id','start_date','requested_days','end_date');
    }
    public function discounts()
    {
        return $this->belongsToMany(\App\Models\Discount::class, 'staff_discounts');//->withPivot('staff_id','start_date','requested_days','end_date');
    }
    public function family_members()
    {
        return $this->hasMany(\App\Models\FamilyMember::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}

<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'subjects';
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
    public function career()
    {
        return $this->belongsTo(\App\Models\Career::class);
    }
    public function staff()
    {
        return $this->belongsToMany(\App\Models\Staff::class, 'staff_subjects');
    }
    public function sworn_declaration_item()
    {
        return $this->hasMany(\App\Models\SwornDeclarationItem::class);
    }
    public function correlative()
    {
        return $this->hasMany(\App\Models\Correlative::class);
    }
    public function study_plan()
    {
        return $this->belongsTo(\App\Models\StudyPlan::class);
    }
    public function exam_table()
    {
        return $this->hasMany(\App\Models\ExamTable::class);
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

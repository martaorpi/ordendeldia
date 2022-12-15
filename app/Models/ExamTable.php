<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExamTable extends Model
{
    use CrudTrait, HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'exam_tables';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['full_name'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getFullNameAttribute() {
        return $this->exam_shift->description.' - '.$this->exam_shift->year.' / '.$this->subject->description;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class)->with('study_plan');
    }

    public function exam_shift()
    {
        return $this->belongsTo(\App\Models\ExamShift::class)->where('type','Turno-Examen');
    }
    public function study_plan()
    {
        return $this->belongsTo(\App\Models\StudyPlan::class, 'study_plan_id');
    }
    /*public function cycle()
    {
        return $this->belongsTo(\App\Models\Cycle::class);
    }*/

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

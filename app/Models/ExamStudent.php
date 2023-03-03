<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExamStudent extends Model
{
    use CrudTrait, HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'exam_students';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['sworn_declaration_item_id','student_id','exam_table_id','exam_act_id','regularity_id','plan_change_id','condition_exam','assistance_exam','written_qualification','oral_qualification','average','approved','promotion','observations'];
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
    public function correlative()
    {
        return $this->belongsTo(\App\Models\Correlative::class, 'subject_id', 'correlative_id');
    }

    public function exam_table()
    {
        return $this->belongsTo(\App\Models\ExamTable::class)->with('subject');
    }

    public function sworn_declaration_item()
    {
        return $this->belongsTo(\App\Models\SwornDeclarationItem::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
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

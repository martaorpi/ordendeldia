<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'user_id',
        'date',
        'hour',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject_id' => 'integer',
        'user_id' => 'integer',
        'date' => 'date',
    ];


    public function subject()
    {
        return $this->belongsTo(\App\Models\Models\Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\Models\User::class);
    }
}

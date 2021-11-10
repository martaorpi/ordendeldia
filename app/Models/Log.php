<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_admin_id',
        'student_id',
        'text',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_admin_id' => 'integer',
        'student_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\UserAdmin::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class);
    }
}

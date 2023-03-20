<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Authority;
use App\Models\Dependence;
use App\Models\Crime;
use App\Models\User;
use App\Models\Person;

class Document extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'documents';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    //protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->user_id = Auth::id();
        });
    }

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

    public function autority()
    {
        return $this->belongsTo(Authority::class);
    }

    public function dependence()
    {
        return $this->belongsTo(Dependence::class, 'dependence_id');
    }

    public function crime()
    {
        return $this->belongsTo(Crime::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complainant()
    {
        return $this->belongsTo(Person::class, 'complainant_id');
    }

    public function victim()
    {
        return $this->belongsTo(Person::class, 'victim_id');
    }

    public function accused()
    {
        return $this->belongsTo(Person::class, 'accused_id');
    }

    /*public function persons()
    {
        return $this->belongsToMany(Person::class, 'document_person','document_id', 'person_id');
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

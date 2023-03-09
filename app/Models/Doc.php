<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Doc extends Model
{
    use CrudTrait;
    //use \Backpack\CRUD\app\Models\Traits\CrudTrait;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'docs';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'src',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
    
        static::deleting(function($obj) {
            //$disk = config('backpack.base.root_disk_name');
            //Storage::disk($disk)->delete('public/'.$this->{$attribute_name});
            parent::boot();
            static::deleting(function($obj) {
                Storage::disk('public/uploads')->delete($obj->src);
            });
        });
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
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
    public function setSrcAttribute($value)
    {
        $disk = config('backpack.base.root_disk_name'); 
        $destination_path = "public/uploads"; 
        $attribute_name = "src";
        if ($value==null) {
            Storage::disk($disk)->delete('public/'.$this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }
        $filename = $value->getClientOriginalName();
        Storage::disk($disk)->put($destination_path.'/'.$filename, file_get_contents($value));
        $this->attributes[$attribute_name] = 'uploads/'.$filename; 
    }
    
}

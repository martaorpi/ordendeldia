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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
    /*public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "/uploads";       
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }*/

    public function setSrcAttribute($value)
    {
        /*$disk = "uploads";//config('backpack.base.root_disk_name'); 
        $destination_path = ""; 
        $attribute_name = "src";
        if ($value==null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }
        if (Str::startsWith($value, 'data:image'))
        {
            $image = \Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.pdf';
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            $public_destination_path = '/'.Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }else{
            $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
            $this->attributes[$attribute_name] = 'public/uploads/'.$value;
        }  */
        $disk = config('backpack.base.root_disk_name'); 
        $destination_path = "public/uploads"; 
        $attribute_name = "src";
        /*if ($value==null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }*/
        $filename = $value->getClientOriginalName();//'Boletin-'.date('d-m-Y').'.pdf';
        $extension = $value->getClientOriginalExtension();
        //$extension = pathinfo($file, PATHINFO_EXTENSION);
        //$image = \Image::make($value);
        //$filename = md5($value.time()).'.pdf';
        //Storage::disk($disk)->put($destination_path.'/'.$filename, $extension);
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
        $this->attributes[$attribute_name] = $destination_path.'/'.$filename; 
    }
    
}

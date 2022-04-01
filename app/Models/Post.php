<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [] ;


    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function setPostImageAttribute($value){
    //     $this->attributes['post_image'] = asset($value);
    // }

    public function getPostImageAttribute($value) {

        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        // return asset('storage/public/images' . $value);

            // dd($this->attributes);
            return Storage::url($this->attributes['post_image']);
        }
 }

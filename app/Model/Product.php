<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=['id'];
    public function getAvatarAttribute($value){
        return 'storage/images'.'/'.$value;
    }
}

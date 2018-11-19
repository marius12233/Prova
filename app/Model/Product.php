<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Review;
use App\Model\Detail;
use App\Model\Tail;
use App\Model\Photo;


class Product extends Model
{
	protected $fillable = [
		'name','detail','stock','price','discount'
	];

    public function reviews(){
    	return $this->hasMany(Review::class);
    }

    public function details(){
    	return $this->hasOne(Detail::class);
    }

    public function tails(){
    	return $this->hasMany(Tail::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }



}

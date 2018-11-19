<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;


class Photo extends Model
{
	protected $fillable=[
		'path'
	];
    
    function product(){
    	return $this->belongsTo(Product::class);
    }
}

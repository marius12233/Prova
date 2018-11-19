<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class Tail extends Model
{
    protected $fillable=[
		'tail','quantity'
	];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

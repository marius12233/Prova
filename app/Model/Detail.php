<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class Detail extends Model
{
    protected $fillable=[
		'brand','man','category','color'
	];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

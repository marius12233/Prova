<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=> $this->detail,
            'price'=>$this->price,
            'stock'=>$this->stock,
            'totalPrice' => round((1-($this->discount/100))*$this->price,2),
            'discount'=>$this->discount,
            'rating'=>$this->reviews->count() > 0 ? $this->reviews->sum('star')/$this->reviews->count(): 'No rating yet',
            'href'=>[
                'reviews'=> route('reviews.index',$this->id),
                'details'=>route('details.index',$this->id),
                'tails' =>route('tails.index',$this->id),
                'photos' =>route('uploadFile.index',$this->id)
            ]

        ];
    }
}

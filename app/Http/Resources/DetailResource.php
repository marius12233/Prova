<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DetailResource extends Resource
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
            'category' => $this->category,
            'brand'=> $this->brand,
            'man'=> $this->man,
            'color'=> $this->color
        ];
    }
}

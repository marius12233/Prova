<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TailResource extends Resource
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
            'tail' => $this->tail,
            'quantity'=> $this->quantity
            
        ];
    }
}

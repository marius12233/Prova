<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

use Exception;

class ProductNoBelongsToAdmin extends Exception
{
    public function render()
    {
    	return response()->json([
            'errors'=>'Product no belongs to Admin!'
        ],Response::HTTP_NOT_FOUND);

    }
}

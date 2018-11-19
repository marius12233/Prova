<?php

namespace App\Exceptions;
use Illuminate\Http\Response;

use Exception;

class ReviewUntouchable extends Exception
{
    public function render()
    {
    	return response()->json([
            'errors'=>'You cannot update this review!'
        ],Response::HTTP_NOT_FOUND);

    }
}

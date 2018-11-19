<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Response;
use Exception;


trait ExceptionTrait

{


	public function isModel($exception)
	{
		return $exception instanceof ModelNotFoundException;
	}

	public  function isHttp($exception)
	{
		return $exception instanceof NotFoundHttpException;
	}

	public  function ModelResponse($exception)
	{
		 return response()->json([
            'errors'=>'Model not found!'
        ],Response::HTTP_NOT_FOUND);

        
	}
	public  function HttpResponse($exception)
	{
        return response()->json([
            'errors'=>'Incorrect URL!'
        ],Response::HTTP_NOT_FOUND);

	}
}



?>
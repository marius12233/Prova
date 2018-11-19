<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Product;
use App\Http\Resources\PhotoResource;
use App\Model\Photo;
use Illuminate\Http\Response;
use App\Http\Controllers\ProductController;
use App\User;
use Illuminate\Support\Facades\Auth;






class PhotoController extends Controller
{


	public function index(Product $product){

		return PhotoResource::collection($product->photos);
	}




    public function create()
    {
        
    }

    public function edit(Review $review)
    {
        //
    }


	public function update(Request $request,Product $product, Photo $photo)
    {
    	ProductController::ProductUserCheck();

        $photo->update($request->all());
        return response([
            'data'=> new PhotoResource($photo)
        ],Response::HTTP_CREATED);

    }


    public function show(Product $product,Photo $photo)
    {
        //return new PhotoResource(Photo::get($photo));
        return [$photo->id,$photo->path];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Photo $photo)
    {
    	ProductController::ProductUserCheck();
        $photo->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }




    public function store(Request $request,Product $product){

    	ProductController::ProductUserCheck();
    	$file = array('image'=>Input::file('file'));
    	if(Input::file('file')->isValid()){
    		$destinationPath = 'assets/img/products/'.$product->id.'/';
    		$extension = Input::file('file')->getClientOriginalExtension();
    		$filename = rand(11111,99999).'.'.$extension;
    		Input::file('file')->move($destinationPath,$filename);
    		$photo = new Photo;
    		$photo->path = $destinationPath.$filename;
    		$product->photos()->save($photo);
    		return ['/'.$destinationPath.$filename];
    	}else{
    		return 'Immagine non valida!';
    	}
    }
}

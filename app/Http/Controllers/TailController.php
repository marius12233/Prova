<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Tail;
use App\Http\Resources\TailResource;
use App\Http\Requests\TailRequest;
use App\User;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;



class TailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return TailResource::collection($product->tails);
    
    }


    public function create()
    {
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TailRequest $request,Product $product)
    {
        ProductController::ProductUserCheck();
        $tail = new Tail($request->all());
        $product->tails()->save($tail);
        return response([
            'data'=> new TailResource($tail)
        ],Response::HTTP_CREATED);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Tail $tail)
    {
        return new TailResource($tail);
    }

    public function edit(Review $review)
    {
        //
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product, Tail $tail)
    {
        
        ProductController::ProductUserCheck();
        //if(!User::isAdmin(Auth::id())){

        //return [Auth::id()];

        //}
        $tail->update($request->all());
        return response([
            'data'=> new TailResource($tail)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Tail $tail)
    {
        ProductController::ProductUserCheck();
        
        $tail->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

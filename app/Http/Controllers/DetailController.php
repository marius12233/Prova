<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Detail;
use App\Http\Resources\DetailResource;
use App\Http\Requests\DetailRequest;
use App\User;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Response;



class DetailController extends Controller
{
    /**
     * Non voglio che si possano vedere tutti i dettagli ma solo del signolo prodotto
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return json_encode($product->details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailRequest $request,Product $product)
    {
        ProductController::ProductUserCheck();
        $detail = new Detail($request->all());
        $product->details()->save($detail);
        return response([
            'data'=> new DetailResource($detail)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Detail $detail)
    {
        return new DetailResource($detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Product $product, Detail $detail)
    {
        ProductController::ProductUserCheck();
        $detail->update($request->all());
        return response([
            'data'=> new DetailResource($detail)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Detail $detail)
    {
        ProductController::ProductUserCheck();
        $detail->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

        //I check se l'utente autenticato è uguale all'utente che ha creato iil prodotto
    
}

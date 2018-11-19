<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ProductNoBelongsToAdmin;
use App\User;
use App\Rule;

class ProductController extends Controller
{
    /*
    public function _construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =Product::paginate(9);
        return  ProductCollection::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Se l'utente non è admin non può creare il prodotto
        /*if(!User::isAdmin(Auth::id())){

            throw new ProductNoBelongsToAdmin;

        }*/
        $this->ProductUserCheck();
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->user_id = Auth::id();
        $product->discount = $request->discount;
        $product->save();
        return response([

            'data'=> new ProductResource($product)

        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        //Controllo se l'utente è admin
        $this->ProductUserCheck();
        //Nella request il campo (che nel db è detail) è chiamato description, quindi andiamo a cambiare il nome per associarlo direttamente all'oggetto product
        $request['detail']=$request->description;
        unset($request['description']);
        $product->update($request->all());
        return response([

            'data'=> new ProductResource($product)

        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->ProductUserCheck();
        $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }

    //I check se l'utente autenticato è uguale all'utente che ha creato iil prodotto
    public static function ProductUserCheck()
    {
       
        //Controllo se il prodotto(come sarà sicuramente) è stato creato dall'admin
        if(!User::isAdmin(Auth::id())){

            throw new ProductNoBelongsToAdmin;

        }

        

    } 
   


        
}

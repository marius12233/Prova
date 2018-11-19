<?php

namespace App\Http\Controllers;

use App\Model\Review;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Response;
use App\Exceptions\ProductNoBelongsToAdmin;
use App\Exceptions\ReviewUntouchable;
use Illuminate\Support\Facades\Auth;
use App\User;




class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * api/products/{product}/reviews and the Product argument is given by the {prouct} parameter
     *Posso creare una review (quindi una recensione) solo se sono loggato
     */
    public function store(ReviewRequest $request,Product $product)
    {
        $review = new Review($request->all());
        //Nel campo user_id di review ci vado a mettere l'id dell'utente che lo sta creando!
        $review->user_id = Auth::id();
        //Per inserire il campo di foreign key utilizziamo il metodo reviews() di product
        $product->reviews()->save($review);
        return response([
            'data'=> new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product, Review $review)
    {
        if(Auth::id() !== $review->user_id){
            throw new ReviewUntouchable;

        }
        $review->update($request->all());
        return response([
            'data'=> new ReviewResource($review)
        ],Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Review $review)
    {
        //Una review può essere eliminata sia dall'utente che l'ha fatta sia dall' admin
        if(Auth::id() !== $review->user_id && !(User::isAdmin(Auth::id())) ){
            throw new ReviewUntouchable;

        }
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, Request $request)
    {
        $user = $request->user();
        if (Review::where(''))
        $data = $request->all();
        $data['work_id'] = $id * 1;
        $review = Review::make($data);
        $review->update($request->json('user_id')->id);
        $review->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request)
    {
        $user = $request->user();
        $review = Review::where('work_id', $id , 'and' , 'user_id', $user->id);
        $review->update($request->all());
        return $review;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}

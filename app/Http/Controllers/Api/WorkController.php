<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Work::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $work = Work::create($request->all());
        $work->types()->attach($request->types);
        return response($work);
    }

    /**
     * Display the specified resource.
     */
    public function showOne(string $id)
    {
 
            $work = Work::with('types')->findOrFail($id);
            return $work;

    }

    public function showAll(Request $request){
        return [
            "data"=> Work::with('types')->get()
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        $work->update($request->all());
        return response($work);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return response($work);
    }
}

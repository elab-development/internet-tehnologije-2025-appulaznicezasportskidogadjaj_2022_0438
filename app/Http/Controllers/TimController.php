<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use App\Http\Controllers\Controller;
use App\Http\Resources\TimResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TimResource::collection(Tim::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'grad' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $tim = Tim::create($data);
        return response()->json(new TimResource($tim),201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new TimResource(Tim::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tim $tim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tim = Tim::find($id);

        if(!$tim){
            return response()->json(['Tim nije pronadjen.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|string|max:255',
            'grad' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $tim->update($data);
        return response()->json($tim,201);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tim = Tim::find($id);

        if(!$tim){
            return response()->json(['Tim nije pronadjen.'], 404);
        }

            $tim->delete();
            return response()->json(['Tim je obrisan.'], 200);
    }
}

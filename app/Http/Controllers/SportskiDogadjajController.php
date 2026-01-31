<?php

namespace App\Http\Controllers;

use App\Models\SportskiDogadjaj;
use App\Http\Controllers\Controller;
use App\Http\Resources\SportskiDogadjajResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SportskiDogadjajController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //Koristim GET metodu
    public function index()
    {
        return SportskiDogadjajResource::collection(SportskiDogadjaj::all());
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
            'opis' => 'required|string',
            'lokacija' => 'required|string|max:255',
            'datumVreme' => 'required|date|after:now',
            'aktivan' => 'required|boolean',
            'korisnikId' => 'required|exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validacija nije prosla.',
                'errors' => $validator->errors(),
            ], 422);
        }
        $data = $validator->validated();
        $sportskiDogadjaj = SportskiDogadjaj::create($data);
        return response()->json(new SportskiDogadjaj($sportskiDogadjaj),201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new SportskiDogadjajResource(SportskiDogadjaj::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportskiDogadjaj $sportskiDogadjaj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sportskiDogadjaj = SportskiDogadjaj::find($id);

        if(!$sportskiDogadjaj){
            return response()->json(['message' => 'SportskiDogadjaj nije pronadjen.'], 404);
        }


        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|string|max:255',
            'opis' => 'sometimes|string',
            'lokacija' => 'sometimes|string|max:255',
            'datumVreme' => 'sometimes|date|after:now',
            'aktivan' => 'sometimes|boolean',
            'korisnikId' => 'sometimes|exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validacija nije prosla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $sportskiDogadjaj->update($data);
       return response()->json(new SportskiDogadjaj($sportskiDogadjaj),201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sportskiDogadjaj = SportskiDogadjaj::find($id);

        if(!$sportskiDogadjaj){
            return response()->json(['message' => 'SportskiDogadjaj nije pronadjen.'], 404);
        }

            $sportskiDogadjaj->delete();
            return response()->json(['message' => 'SportskiDogadjaj je obrisan.'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ulaznica;
use App\Http\Controllers\Controller;
use App\Http\Resources\UlaznicaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UlaznicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UlaznicaResource::collection(Ulaznica::all());
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
            'kategorijaUlaznicaId' => 'required|exists:kategorijeulaznica,id',
            'korisnikId' => 'required|exists:users,id',
            'status' => 'required|in:AKTIVNA,ISKORISCENA,OTKAZANA',
            'qrKod' => 'required|string|unique:ulaznice,qrKod',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prosla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $ulaznica = Ulaznica::create($validator->validated());
        return response()->json(new UlaznicaResource($ulaznica, 201));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new UlaznicaResource(Ulaznica::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulaznica $ulaznica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ulaznica = Ulaznica::find($id);

        if(!$ulaznica){
            return response()->json(['Ulaznica nije pronadjena.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kategorijaUlaznicaId' => 'sometimes|exists:kategorijeulaznica,id',
            'korisnikId' => 'sometimes|exists:users,id',
            'status' => 'sometimes|in:AKTIVNA,ISKORISCENA,OTKAZANA',
            'qrKod' => 'sometimes|string|unique:ulaznice,qrKod',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prosla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $ulaznica->update($data);
        return response()->json($ulaznica,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ulaznica = Ulaznica::find($id);

        if(!$ulaznica){
            return response()->json(['Ulaznica nije pronadjena.'], 404);
        }

            $ulaznica->delete();
            return response()->json(['Ulaznica je obrisana.'], 200);
    }
}

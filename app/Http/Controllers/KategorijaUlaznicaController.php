<?php

namespace App\Http\Controllers;

use App\Models\KategorijaUlaznica;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategorijaUlaznicaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategorijaUlaznicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KategorijaUlaznicaResource::collection(KategorijaUlaznica::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dogadjajId' => 'required|exists:sportskidogadjaji,id',
            'naziv' => 'required|string|max:255',
            'tipSedista' => 'required|string|max:100',
            'cena' => 'required|numeric|min:0',
            'kapacitet' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $kategorija = KategorijaUlaznica::create($data);

        return response()->json(new KategorijaUlaznicaResource($kategorija),201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new KategorijaUlaznicaResource(KategorijaUlaznica::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategorijaUlaznica $kategorijaUlaznica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategorija = KategorijaUlaznica::find($id);

        if(!$kategorija){
            return response()->json(['message' => 'Kategorija Ulaznice nije pronadjena.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'dogadjajId' => 'sometimes|exists:sportskidogadjaji,id',
            'naziv' => 'sometimes|string|max:255',
            'tipSedista' => 'sometimes|string|max:100',
            'cena' => 'sometimes|numeric|min:0',
            'kapacitet' => 'sometimes|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $kategorija->update($data);
        return response()->json(new KategorijaUlaznicaResource($kategorija), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategorija = KategorijaUlaznica::find($id);

        if(!$kategorija){
            return response()->json(['message' => 'Kategorija nije pronadjena.'], 404);
        }

            $kategorija->delete();
            return response()->json(['message' => 'Kategorija je obrisana.'], 200);
    }
}

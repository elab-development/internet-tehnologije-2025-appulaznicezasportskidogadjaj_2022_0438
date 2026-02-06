<?php

namespace App\Http\Controllers;

use App\Models\KategorijaUlaznica;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategorijaUlaznicaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        /** @var User $user */
        $user = Auth::user();

        //admin može kreirati kategorije ulaznica
        if (!$user || !$user->canCreateEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da kreirate kategoriju ulaznice. Samo admin može kreirati kategorije.',
            ], 403);
        }

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

        return response()->json(new KategorijaUlaznicaResource($kategorija), 201);
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
        /** @var User $user */
        $user = Auth::user();

        // samo admin i moderator mogu menjati kategorije 
        if (!$user || !$user->canEditEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da menjate kategoriju ulaznice. Samo admin i moderator mogu menjati kategorije.',
            ], 403);
        }

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
        /** @var User $user */
        $user = Auth::user();

        // samo admin može brisati kategorije 
        if (!$user || !$user->canDeleteEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da obrišete kategoriju ulaznice. Samo admin može brisati kategorije.',
            ], 403);
        }

        $kategorija = KategorijaUlaznica::find($id);

        if(!$kategorija){
            return response()->json(['message' => 'Kategorija nije pronadjena.'], 404);
        }

        $kategorija->delete();
        return response()->json(['message' => 'Kategorija je obrisana.'], 200);
    }
}
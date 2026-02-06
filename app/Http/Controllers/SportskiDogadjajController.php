<?php

namespace App\Http\Controllers;

use App\Models\SportskiDogadjaj;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\SportskiDogadjajResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SportskiDogadjajController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        /** @var User $user */
        $user = Auth::user();

        
        if (!$user || !$user->canCreateEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da kreirate sportski dogadjaj. Samo admin može kreirati dogadjaje.',
            ], 403);
        }

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

        return response()->json(new SportskiDogadjajResource($sportskiDogadjaj), 201);
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
        /** @var User $user */
        $user = Auth::user();

        
        if (!$user || !$user->canEditEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da menjate sportski dogadjaj. Samo admin i moderator mogu menjati dogadjaje.',
            ], 403);
        }

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

        return response()->json(new SportskiDogadjajResource($sportskiDogadjaj), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = Auth::user();

        
        if (!$user || !$user->canDeleteEvent()) {
            return response()->json([
                'message' => 'Nemate dozvolu da obrišete sportski dogadjaj. Samo admin može brisati dogadjaje.',
            ], 403);
        }

        $sportskiDogadjaj = SportskiDogadjaj::find($id);

        if(!$sportskiDogadjaj){
            return response()->json(['message' => 'SportskiDogadjaj nije pronadjen.'], 404);
        }

        $sportskiDogadjaj->delete();
        return response()->json(['message' => 'SportskiDogadjaj je obrisan.'], 200);
    }
}
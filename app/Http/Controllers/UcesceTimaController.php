<?php

namespace App\Http\Controllers;

use App\Models\UcesceTima;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UcesceTimaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UcesceTimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UcesceTimaResource::collection(UcesceTima::all());
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
                'message' => 'Nemate dozvolu da kreirate učešće tima. Samo admin može kreirati učešća.',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'dogadjajId' => 'required|exists:sportskidogadjaji,id',
            'timId' => 'required|exists:timovi,id',
            'uloga' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $ucesce = UcesceTima::create($data);

        return response()->json(new UcesceTimaResource($ucesce), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new UcesceTimaResource(UcesceTima::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UcesceTima $ucesceTima)
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
                'message' => 'Nemate dozvolu da menjate učešće tima. Samo admin i moderator mogu menjati učešća.',
            ], 403);
        }

        $ucesce = UcesceTima::find($id);

        if (!$ucesce) {
            return response()->json(['message' => 'Ucesce nije pronadjeno.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'dogadjajId' => 'sometimes|exists:sportskidogadjaji,id',
            'timId' => 'sometimes|exists:timovi,id',
            'uloga' => 'sometimes|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validacija nije prošla.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $ucesce->update($data);

        return response()->json(new UcesceTimaResource($ucesce), 200);
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
                'message' => 'Nemate dozvolu da obrišete učešće tima. Samo admin može brisati učešća.',
            ], 403);
        }

        $ucesce = UcesceTima::find($id);

        if(!$ucesce){
            return response()->json(['message' => 'Ucesce nije pronadjeno.'], 404);
        }

        $ucesce->delete();
        return response()->json(['message' => 'Ucesce je obrisano.'], 200);
    }
}
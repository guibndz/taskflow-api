<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService) {}

    // GET /api/users/{id}/profile
    public function show($id)
    {
        $profile = $this->profileService->getProfileByUserId($id);

        if (!$profile) {
            return response()->json([
                'message' => 'Perfil não encontrado.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $profile
        ], 200);
    }

    // PUT /api/users/{id}/profile
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'avatar_url' => 'nullable|url', // Valida se é um link de imagem válido
        ]);

        $profile = $this->profileService->updateOrCreateProfile($id, $validatedData);

        return response()->json([
            'data' => $profile,
            'message' => 'Perfil salvo com sucesso.'
        ], 200);
    }
}
<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
{
    public function getProfileByUserId(int $userId): ?Profile
    {
        // Busca o perfil pela coluna user_id
        return Profile::where('user_id', $userId)->first();
    }

    public function updateOrCreateProfile(int $userId, array $data): Profile
    {
        // O primeiro array é a condição de busca (onde user_id = $userId)
        // O segundo array são os dados que queremos preencher/atualizar
        return Profile::updateOrCreate(
            ['user_id' => $userId],
            $data
        );
    }
}
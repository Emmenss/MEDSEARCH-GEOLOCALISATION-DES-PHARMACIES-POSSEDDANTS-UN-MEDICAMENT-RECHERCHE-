<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\File;
use Illuminate\Support\Facades\Log;


class FileImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user();

        // Rechercher un fichier existant basé sur le nom et la présentation
        $existingFile = $user->files()
            ->where('name', $row["noms"])
            ->where('presentation', $row['prstation'])
            ->first();

        if ($existingFile) {
            // Mettre à jour l'enregistrement existant
            $existingFile->update([
                'prix' => $row['prix'],
                'quantite' => $row['qte']
                // Ajoutez d'autres champs à mettre à jour si nécessaire
            ]);

            Log::info("Fichier existant mis à jour : " . $existingFile->id);
            return $existingFile;
        } else {
            // Créer un nouveau fichier si aucun n'existe avec le même nom et présentation
            $file = $user->files()->create([
                'name' => $row["noms"],
                'presentation' => $row['prstation'],
                'prix' => $row['prix'],
                'quantite' => $row['qte']
                // Ajoutez d'autres champs si nécessaire
            ]);

            Log::info("Nouveau fichier créé : " . $file->id);
           
            return $file;
        }
    }
}

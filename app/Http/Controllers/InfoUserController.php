<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class InfoUserController extends Controller
{
    public function create()
{
    // Récupérer le chemin d'accès à l'image de profil de l'utilisateur
    $profilePicture = Auth::user()->profile_picture;

    return view('laravel-examples/user-profile', compact('profilePicture'));
}


public function store(Request $request)
{
    // Valider les entrées
    $attributes = $request->validate([
        'picture' => 'nullable|image|max:2048',
        'name' => ['required', 'max:50'],
        'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
        'phone' => ['nullable', 'max:50'],
        'location' => ['nullable', 'max:70'],
        'about_me' => ['nullable', 'max:150'],
    ]);

    // Vérification de l'email pour les comptes de démonstration
    if ($request->email != Auth::user()->email && env('IS_DEMO') && Auth::user()->id == 1) {
        return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
    }

    $user = Auth::user();

    // Traitez le téléchargement de l'image
    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // Générer un nom de fichier unique
        $filePath = $file->storeAs('picture', $filename, 'public'); // Enregistrer l'image dans le stockage public

        // Si le fichier a été téléchargé avec succès, mettez à jour le chemin de l'image dans les attributs
        if ($filePath) {
            // Convertir l'image en base64
            $encodedImage = base64_encode(file_get_contents($file->getRealPath()));
            // Mettre à jour le chemin de l'image encodée en base64
            $attributes['picture'] = $encodedImage;
        }
    }

    // Mettre à jour les informations de l'utilisateur
    $user->update($attributes);

    // Rediriger avec un message de succès
    return redirect('/user-profile')->with('success', 'Profile updated successfully');
}

    



    
}

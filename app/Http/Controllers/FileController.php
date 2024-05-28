<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function importfile(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('filedata');
        
        Excel::import(new FileImport, $file); // Importer les données

        $files = $user->files; // Charger les fichiers associés à l'utilisateur

        return view('tables', compact('files'));
    }

    public function index()
    {
        $user = Auth::user();
        // Vérifier si l'utilisateur est authentifié et a le rôle "pharmacie"
        if (!$user || !$user->profil=='pharmacie') {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }

        $files = $user->files; // Charger les fichiers associés à l'utilisateur

        return view('tables', compact('files'));
    }

    public function search(Request $request)
{
    $searchQuery = $request->get('query');
    
    // Recherche des fichiers contenant le nom du médicament recherché
    $files = File::where('name', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('presentation', 'LIKE', '%' . $searchQuery . '%')
        ->get(); // Récupère les fichiers correspondant à la recherche

    // Récupération des pharmacies correspondantes
    $pharmacies = User::whereIn('id', $files->pluck('user_id'))
        ->where('profil', 'pharmacie')
        ->get();

    return view('accueil', compact('pharmacies', 'files'));
}


    public function getinfos()
    {
        return view('infos');
    }
}



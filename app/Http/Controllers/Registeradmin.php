<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Registeradmin extends Controller
{
    public function storeadmin(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:7|max:255',
                'profil' => 'max:255',
                'agreement' => 'accepted', // Assurez-vous que le nom correspond à votre formulaire
            ], [
                'name.required' => 'Veuillez renseigner votre nom',
                'email.required' => 'Veuillez renseigner votre Email',
                'password.required' => 'Veuillez renseigner votre Mot de passe',
                'agreement.accepted' => 'Vous devez accepter les termes et conditions'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profil' => $request->profil,
            ]);
    
            $users = User::all();
            return view('laravel-examples/user-management', compact('users'))->with('success', 'Utilisateur ajouté avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si une exception de validation est levée, nous récupérons les erreurs et les retournons avec un message approprié.
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Si une autre exception est levée, nous retournons un message d'erreur général.
            return back()->with('error', 'Une erreur s\'est produite lors de la création de l\'utilisateur.');
        }
    }
    

       public function indexuser(){
              $users=User::all();
              return view('laravel-examples/user-management', compact('users'));

        }

        public function destroy($id){

            $users = User::find($id);
            $users->delete();
            return redirect()->route('user-management')->with('success', 'Usersupprimé avec succes');

        }


}

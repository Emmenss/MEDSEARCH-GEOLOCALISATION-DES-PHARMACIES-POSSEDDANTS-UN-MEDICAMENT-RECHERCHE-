<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\Registeradmin;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    // 
	Route::get('/', function () {
		return view('accueil'); // Remplacez 'accueil' par le nom de votre vue d'accueil
	})->name('accueil');
	

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');


	// Route::get('tables', function () {
	// 	return view('tables');
	// })->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');


	// Route::get('accueil', function () {
	// 	return view('accueil');
	// })->name('accueil');


    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');



//importing file
Route::post('/fileimported', [FileController::class, 'importfile'])->name('fileimported')->middleware('auth');
Route::get('/tables', [FileController::class, 'index'])->name('tables')->middleware('auth');




//user-management

Route::post('/adduser', [Registeradmin::class, 'storeadmin'])->name('adduser')->middleware('auth');
Route::get('/user-management', [Registeradmin::class, 'indexuser'])->name('user-management')->middleware('auth');


Route::get('/accueil', [FileController::class, 'search'])->name('search');


//infos localisation
Route::get('/infos/{pharmacie_nom}', function ($pharmacie_nom) {
    return view('infos', ['pharmacie_nom' => $pharmacie_nom]);
})->name('infos');


// Route::get('/infos/{location}', function ($location) {
//     return view('infos', ['location' => $location]);
// })->name('infos');

Route::delete('/supprimer/{id}', [Registeradmin::class, 'destroy'])->name('deleteuser');

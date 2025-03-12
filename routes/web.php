<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [MainController::class, 'login']);

Route::post('/login', [MainController::class, 'login_fun']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [MainController::class, 'register_fun']);

Route::get('/home', [MovieController::class, 'index']);

Route::get('/logout', function () {
    session()->forget('LoggedUser'); // Remove the user session
    return redirect('/login'); // Redirect to the login page
});
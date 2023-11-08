<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// // the route for this will be this http://laragigs.test/hello and it prints Hello World on screen
// Route::get('/hello', function () {
//     return response("<h1>Hello World</h1>")
//         ->header('Content-Type', 'text/plain')
//         ->header('foo', 'bar');
// });

// // {id} whilecard id
// // ->where("id", '[0~9]+'); constraints
// // dd die and dump helper method for debugging this will stop everything and show me that whatever pass in
// // ddd Dump, Die, Debug -> this will show more details information
// Route::get('/posts/{id}', function ($id) {
//     // dd($id);
//     // ddd($id);
//     return response("Post " . $id);
// })->where("id", '[0-9]+');


// Route::get('/search', function (Request $request) {
//     return $request->name . ' ' . $request->city;
// });


// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing


// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');;

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');;

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');;

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');;

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');;

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

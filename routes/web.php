<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'API is running']);
});


// use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// })->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('dashboard', function () {
//         return Inertia::render('dashboard');
//     })->name('dashboard');
// });

//  require __DIR__.'/settings.php';
//  require __DIR__.'/auth.php';

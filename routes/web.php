<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return View('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/buku', [BukuController::class, 'index']);
//     Route::get('/buku/create', [BukuController::class, 'create'])->middleware('admin')->name('buku.create');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


//     // Tidak perlu grup middleware 'admin' di sini.

//     Route::middleware(['admin'])->group(function () {


//         Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
//         Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
//         Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    
//         Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
//         Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
// });

// });


// Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create')->middleware('admin');
// Route::get('/buku',[BukuController::class, 'index'])->name('buku');

Route::group(['middleware'=>['auth']], function () {

Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create')->middleware('admin');
Route::get('/buku',[BukuController::class, 'index'])->name('buku');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['middleware' => ['admin']], function() {
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/edit/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

    });

});


require __DIR__.'/auth.php';

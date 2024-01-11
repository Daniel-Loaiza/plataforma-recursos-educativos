<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// })->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('resources/create',[ResourceController::class,'create'])->name('create');
    Route::post('resources/create/store',[ResourceController::class,'store'])->name('create.store');
    Route::get('resources/{id}/edit',[ResourceController::class,'edit'])->name('resource.edit');
    Route::put('resources/{id}/update',[ResourceController::class,'update'])->name('resource.update');
    Route::post('resources/{id}/delete',[ResourceController::class,'destroy'])->name('resource.delete');    
});

Route::get('/',[ResourceController::class,'index'])->name('resources');



//Rutas para filtrar con vue
Route::get('api/resources', [ResourceController::class,'search']);
Route::get('api/categories',[CategoryController::class,'index']);

//Pagina adicional
Route::inertia('about','About')->name('about');

require __DIR__.'/auth.php';

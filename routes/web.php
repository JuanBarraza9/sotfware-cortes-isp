<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//* Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminDestroy'])->name('admin.logout');

    // admin seccion
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');

    // admin users seccion
    Route::get('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register');
    Route::post('/admin/register/store', [AdminController::class, 'adminRegisterStore'])->name('admin.register.store');

    // admin api
    Route::get('/admin/generar-activacion', [ApiController::class, 'generarActive'])->name('generar-active');
    Route::post('/admin/generar-activacion/post', [ApiController::class, 'generarActivePost'])->name('generar-active-post');
    Route::get('/admin/generar-cortes', [ApiController::class, 'generarCortes'])->name('generar-cortes');
    Route::post('/admin/generar-cortes/post', [ApiController::class, 'generarCortesPost'])->name('generar-cortes-post');
});

require __DIR__.'/auth.php';

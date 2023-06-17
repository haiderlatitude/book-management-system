<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminRolesAndPermissionsController;
use App\Http\Controllers\AdminUserController;

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
    return redirect('/admin');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth', 'verified')->group(function(){
    Route::group(['middleware' => ['role:admin', 'can:access']], function(){
        Route::get('/all-users', [AdminUserController::class, 'index'])->name('all-users');
        Route::get('/roles-and-permissions', [AdminRolesAndPermissionsController::class, 'index'])
            ->name('roles-and-permissions');
    });
    Route::get('/admin', [AdminBookController::class, 'index']);
    Route::get('/edit/{id}', [AdminBookController::class, 'showBook']);
    Route::get('/book-details', [AdminBookController::class, 'enterBookDetails']);
    Route::post('/assign-role', [AdminRolesAndPermissionsController::class, 'assignRole']);
    Route::post('/delete-role', [AdminRolesAndPermissionsController::class, 'destroy']);
    Route::post('/remove-role', [AdminRolesAndPermissionsController::class, 'removeRole']);
    Route::post('/store', [AdminBookController::class, 'store']);
    Route::put('/update/{id}', [AdminBookController::class, 'update']);
    Route::delete('/delete/{id}', [AdminBookController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

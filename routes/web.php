<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Lead;
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
    return to_route('login');
});



Route::get('/mailable', function () {
    /* $lead = [
        'name' => 'Fabio',
        'email' => 'fabio@example.com',
        'message' => 'lorem ipsum dolor hi'
    ]; */

    $lead = Lead::find(1);

    return new App\Mail\NewLeadMessageMd($lead);
});



Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        // Put here all routes that needs to be protected by our authenticatio system
        // All routes need to share a common name and prefix and the middleware
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); //admin
        Route::resource('posts', PostController::class)->parameters([
            'posts' => 'post:slug'
        ]);
    });






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

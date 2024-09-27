<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;

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
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Ticket routes
Route::middleware('auth')->group(function () {
    Route::get('/all/tickets', [TicketController::class, 'index'])->name('all.ticket');
    Route::get('/create/ticket', [TicketController::class, 'createTicket'])->name('create.ticket');
    Route::post('/store/ticket', [TicketController::class, 'store'])->name('store.ticket');
    Route::get('/close/ticket/{id}', [TicketController::class, 'closeTicket'])->name('close.ticket');
});
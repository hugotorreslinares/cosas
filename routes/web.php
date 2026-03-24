<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Http\Controllers\ItemController;
use Inertia\Inertia;

Route::get('/', function () {
    $items = Item::query()
        ->with('user:id,name')
        ->where('is_published', true)
        ->latest()
        ->get();

    return Inertia::render('Home', [
        'items' => $items,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('items', ItemController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    Route::patch('/items/{item}/publish', [ItemController::class, 'publish'])->name('items.publish');
    Route::patch('/items/{item}/unpublish', [ItemController::class, 'unpublish'])->name('items.unpublish');
});

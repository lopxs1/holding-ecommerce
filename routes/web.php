<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoldingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

// Landing page abre a view home
Route::get('/', function () {
    return view('home');
})->name('home');

// Se quiser reutilizar o controller, sem middleware de auth:
Route::get('/home', [HomeController::class, 'index'])->name('home.page');

Auth::routes();

// Holdings (listar e ver detalhes)
Route::resource('holdings', HoldingController::class)->only(['index', 'show']);

// Carrinho (usa holding_id)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{holding}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{holdingId}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{holdingId}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout e pedidos (somente autenticado)
Route::middleware('auth')->group(function () {
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});

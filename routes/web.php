<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoldingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminHoldingController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('holdings', AdminHoldingController::class); // CRUD completo
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
});


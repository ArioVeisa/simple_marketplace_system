<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('marketplace.index');
});

Route::get('/auth/google', [\App\Http\Controllers\Auth\SocialAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\SocialAuthController::class, 'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transactions.show');
        Route::post('transactions/{transaction}/status', [\App\Http\Controllers\Admin\TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

        Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/products/excel', [\App\Http\Controllers\Admin\ReportController::class, 'exportProductsExcel'])->name('reports.products.excel');
        Route::get('reports/products/pdf', [\App\Http\Controllers\Admin\ReportController::class, 'exportProductsPdf'])->name('reports.products.pdf');
        Route::get('reports/transactions/excel', [\App\Http\Controllers\Admin\ReportController::class, 'exportTransactionsExcel'])->name('reports.transactions.excel');
        Route::get('reports/transactions/pdf', [\App\Http\Controllers\Admin\ReportController::class, 'exportTransactionsPdf'])->name('reports.transactions.pdf');

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    });

    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/marketplace', [\App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{slug}', [\App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');

require __DIR__.'/auth.php';

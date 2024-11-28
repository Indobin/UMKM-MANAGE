<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return redirect('/admin'); //
});
// Route::get('/invoice/{transaction}', [InvoiceController::class, 'print'])->name('invoice.print');
Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('invoice.print');

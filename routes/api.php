<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('admin/type-to-medicines/{type}',[BillController::class, 'typeToMedicines'])->name('typeToMedicines');
Route::get('admin/searchBook',[BookController::class, 'searchBook'])->name('searchBook');

Route::get('admin/medicine-to-bill/{id}',[BillController::class, 'medicineToBill'])->name('medicineToBill');

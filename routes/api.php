<?php

// use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['auth:sanctum'],function(){
//     Route::get('product/search/{name}', [ProductController::class, 'search'])->name('product#Search')->middleware('auth:sanctum');
// });
// User
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('showUsers', [AuthController::class, 'showUsers']);
// ->middleware('auth:sanctum');


Route::get('search/{name}', [ProductController::class, 'search'])->name('product#Search');
Route::apiResource('product', ProductController::class);



// Route::prefix('product')->group(function () {

// });

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

Route::get('/apple', function () {
    return response()->json([
        'apple' => 'apple'
    ]);
});

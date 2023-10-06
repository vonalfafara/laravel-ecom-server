<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

// Authentication routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//Public routes
//Product
Route::get("/products", [ProductController::class, "index"]);
Route::get("/categories", [ProductController::class, "getCategories"]);
Route::get("/products/filter", [ProductController::class, "getFilteredProducts"]);

Route::group(["middleware" => ["auth:sanctum"]], function() {

  //Cart
  Route::get("/cart", [CartController::class, "index"]);
  Route::post("/cart", [CartController::class, "store"]);
  Route::put("/cart/increment-quantity/{id}", [CartController::class, "incrementQuantity"]);
  Route::put("/cart/decrement-quantity/{id}", [CartController::class, "decrementQuantity"]);
  Route::delete("/cart/{id}", [CartController::class, "destroy"]);

  //Order
  Route::get("/orders", [OrderController::class, "getOrders"]);
  Route::get("/order/{id}", [OrderController::class, "getOrderItems"]);
  Route::post("/order", [OrderController::class, "placeOrder"]);

  Route::post("/logout", [AuthController::class, "logout"]);
});
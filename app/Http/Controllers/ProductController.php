<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index() {
        // return ProductResource::collection(Product::all());
        // return Product::paginate(10);
        return ProductResource::collection(Product::paginate(20));
    }
}

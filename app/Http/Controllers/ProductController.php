<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

class ProductController extends Controller
{
    public function index() {
        return ProductResource::collection(Product::paginate(20));
    }

    public function getCategories() {
        return CategoryResource::collection(Category::all());
    }

    public function getFilteredProducts(Request $request) {
        $products = Product::where("name", "like", "%" . $request->query("search") . "%");

        if ($request->query("category") === "0") {
            $products = $products->whereBetween("price", [$request->query("min-price"), $request->query("max-price")]);
        } else {
            $products = $products->where("category_id", $request->query("category"))->whereBetween("price", [(float) $request->query("min-price"), (float) $request->query("max-price")]);
        }

        if ($request->query("sort") === "price") {
            $products = $products->orderBy($request->query("sort"), $request->query("asc"));
        } else if ($request->query("sort") === "name") {
            $products = $products->orderBy($request->query("sort"), $request->query("asc"));
        }

        $products = $products->paginate(20);
        return ProductResource::collection($products);
    }
}

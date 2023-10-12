<?php

namespace App\Http\Controllers;

use validation;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return [['products' => $products]];
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =  $request->validate([
            'name' => 'required|string',
            'price' => 'required'
        ]);

        $product = Product::create($validator);
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        if ($product) {
            return response()->json([
                'product GET' => $product
            ]);
        } else {
            return response()->json([
                'product error' => 'error GET product'
            ]);
        }
    }

    public function search($name)
    {
        //
        $product = Product::where('name', 'like', '%' . $name . '%')->get();
        if ($product) {
            return response()->json([
                'product search' => $product
            ]);
        } else {
            return response()->json([
                'product fail' => 'fail'
            ]);
        }
    }






    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validator =  $request->validate([
            'name' => 'required|string',
            'price' => 'required'
        ]);

        if ($product->update($validator)) {
            return response()->json([
                'update Product' => $product,
                'message' => 'product UPDate Good'
            ]);
        } else {
            return response()->json([

                'message' => 'UPDate Fail'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        if ($product->delete()) {
            return response()->json([
                'product Delete' => $product,
                'product delete message' => 'delete complete'
            ]);
        } else {
            return response()->json([
                'product Delete Error' => 'Delete product error'
            ]);
        }
    }
}

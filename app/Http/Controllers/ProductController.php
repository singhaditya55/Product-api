<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $img_filename = $image->getClientOriginalName();
                $filePath = $image->storeAs('product_images', $img_filename, 'public');
                if ($filePath) {
                    $file_path = '/storage/' . $filePath;
                    $imagePaths[] = $file_path;
                }
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'images' => implode(',', $imagePaths),
        ]);

        return response()->json([
            'status' => 201,
            'data' => [
                'message' => 'Data has been added successfully'
            ]
        ]);
    }

    public function index()
    {
        $products = Product::paginate(10);

        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'No data',
                'data' => []
            ], 200);
        }

        $products->getCollection()->transform(function ($product) {
            $product->images = explode(',', $product->images);
            return $product;
        });

        return response()->json([
            'status' => 201,
            'data' => [
                'current_page' => $products->currentPage(),
                'data' => $products->items(),
                'total' => $products->total()
            ]
        ]);
    }
}

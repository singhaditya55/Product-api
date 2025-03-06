<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
            $image = $request->file('images');      
            $img_filename = time() . '_' . $image->getClientOriginalName();
        
            $filePath = $image->storeAs('product_images', $img_filename, 'public'); 
        
            if ($filePath) {
                $file_path = '/storage/' . $filePath; 
                $imagePaths[] = $file_path; 
            }
        }

         Product::create([
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

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Cart::create([
            'user_id' => 1, // Hardcoded User ID
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'status' => 201,
            'data' => [
                'message' => 'Product has been added to cart successfully'
            ]
        ]);
    }

    public function cartList()
    {
        $cartItems = Cart::with('product')->where('user_id', 1)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => 'No data',
                'data' => []
            ], 200);
        }

        $cartItems->transform(function ($cart) {
            $cart->product->images = explode(',', $cart->product->images);
            return $cart;
        });

        return view('cart', ['cartItems' => $cartItems]);
    }
}

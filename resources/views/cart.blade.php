<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
<div class="container mx-auto my-10 p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">🛒 Shopping Cart</h1>

    @if(count($cartItems) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Product Name</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Images</th>
                        <th class="py-3 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cart)
                        <tr class="hover:bg-gray-100 border-b border-gray-200">
                            <td class="py-4 px-6 font-semibold text-gray-700">{{ $cart->product->name }}</td>
                            <td class="py-4 px-6 text-gray-700">₹{{ $cart->product->price }}</td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    @foreach($cart->product->images as $image)
                                        <img src="{{ asset($image) }}" alt="Image" class="w-16 h-16 rounded-lg border">
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-2xl text-red-500">No items in the cart 😔</p>
        </div>
    @endif
</div>
</body>
</html>

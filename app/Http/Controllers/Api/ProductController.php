<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
// Liste: filtreleme, sayfalama eklenebilir
public function index()
{
    // Sadece stok > 0 olanları da filter olarak sunmak istiyorsanız?
    $products = Product::with('category')->paginate(15);
    return response()->json($products);
}


public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    $product = Product::create($data);
    return response()->json($product, 201);
}


public function show(Product $product)
{
return response()->json($product->load('category'));
}


public function update(UpdateProductRequest $request, Product $product)
{
$product->update($request->validated());
return response()->json($product);
}


// DELETE: 
public function destroy(Request $request, Product $product)
{
$product->delete();
return response()->json(['message' => 'Product deleted.']);
}
}
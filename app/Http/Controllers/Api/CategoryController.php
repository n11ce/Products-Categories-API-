<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
// Listeleme
public function index()
{
return response()->json(Category::withCount('products')->get());
}


// Oluştur
public function store(StoreCategoryRequest $request)
{
$category = Category::create($request->validated());
return response()->json($category, 201);
}


// Göster
public function show(Category $category)
{
return response()->json($category->load('products'));
}


// Güncelle
public function update(UpdateCategoryRequest $request, Category $category)
{
$category->update($request->validated());
return response()->json($category);
}


// Sil: Silince ürünler "Genel" kategorisine aktarılacak
public function destroy(Request $request, Category $category)
{
// Genel kategoriyi bul veya yarat
$general = Category::firstOrCreate(['slug' => 'genel'], ['name' => 'Genel']);


// Bu kategoriye ait ürünleri genel kategoriye taşı
Product::where('category_id', $category->id)->update(['category_id' => $general->id]);


// Şimdi kategoriyi silebiliriz
$category->delete();


return response()->json(['message' => 'Category deleted and products moved to Genel.']);
}
}
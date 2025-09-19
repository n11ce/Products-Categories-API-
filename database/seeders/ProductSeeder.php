<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
class ProductSeeder extends Seeder
{
public function run()
{
    $cat = Category::where('slug','electronics')->first();
        Product::create([
        'title' => 'Example Phone',
        'description' => 'A seeded phone',
        'stock' => 10,
        'price_tl' => 19999.00,
        'price_eur' => 999.99,
        'category_id' => $cat->id
    ]);
        $cat2 = Category::where('slug','books')->first();
        Product::create([
        'title' => 'Laravel for Beginners',
        'description' => 'Seeded book',
        'stock' => 5,
        'price_tl' => 299.00,
        'price_eur' => 14.99,
        'category_id' => $cat2->id
        ]);
    }
}

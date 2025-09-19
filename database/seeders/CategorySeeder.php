<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
public function run()
{
    Category::firstOrCreate(['slug' => 'genel'], ['name' => 'Genel']);
    Category::firstOrCreate(['slug' => 'electronics'], ['name' =>
    'Electronics']);
    Category::firstOrCreate(['slug' => 'books'], ['name' => 'Books']);
    }
}

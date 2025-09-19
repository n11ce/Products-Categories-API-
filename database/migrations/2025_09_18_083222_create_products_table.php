<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration
{
public function up()
{
Schema::create('products', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->text('description')->nullable();
$table->unsignedInteger('stock')->default(0); // stok bilgisi
// Fiyatlar TL ve EUR olarak saklanıyor
$table->decimal('price_tl', 12, 2)->default(0);
$table->decimal('price_eur', 12, 2)->default(0);
// Kategori ilişkisi
$table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
$table->timestamps();
});
}


public function down()
{
Schema::dropIfExists('products');
}
}
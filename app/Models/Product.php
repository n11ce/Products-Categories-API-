<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
use HasFactory;


protected $fillable = [
'title','description','stock','price_tl','price_eur','category_id'
];


// Kısa helper: stok var mı?
public function inStock()
{
return $this->stock > 0;
}


public function category()
{
return $this->belongsTo(Category::class);
}
}
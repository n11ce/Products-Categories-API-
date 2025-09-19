<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StoreProductRequest extends FormRequest
{
public function authorize()
{
// API auth middleware uygulanıyorsa true dönebiliriz
return true;
}


public function rules()
{
return [
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'stock' => 'required|integer|min:1',
'price_tl' => 'required|numeric|min:0',
'price_eur' => 'required|numeric|min:0',
'category_id' => 'required|exists:categories,id',
];
}
}
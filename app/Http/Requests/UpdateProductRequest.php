<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UpdateProductRequest extends FormRequest
{
public function authorize() { return true; }


public function rules()
{
return [
'title' => 'sometimes|required|string|max:255',
'description' => 'nullable|string',
'stock' => 'sometimes|required|integer|min:1', 
'price_tl' => 'sometimes|required|numeric|min:0',
'price_eur' => 'sometimes|required|numeric|min:0',
'category_id' => 'sometimes|required|exists:categories,id',
];
}
}
<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UpdateCategoryRequest extends FormRequest
{
public function authorize() { return true; }


public function rules()
{
$category = $this->route('category');
$id = $category ? $category->id : null;
return [
'name' => 'sometimes|required|string|max:255',
'slug' => "sometimes|required|string|max:255|unique:categories,slug,{$id}",
];
}
}
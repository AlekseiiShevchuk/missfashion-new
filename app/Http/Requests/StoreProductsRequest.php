<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            
            'source_url' => 'required',
            
            
            
            
            
            
            
            
            
            'images.*' => 'exists:images,id',
            'colors.*' => 'exists:colors,id',
            'sizes.*' => 'exists:sizes,id',
        ];
    }
}

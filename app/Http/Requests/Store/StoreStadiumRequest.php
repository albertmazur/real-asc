<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreStadiumRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => ["required" , "string"],
            "city" => ["required" , "string"],
            "street" => ["required" , "string"],
            "numberBuilding" => ["required" , "string"],
            "places" => ["required" , "integer", "min:0"],
        ];
    }
}

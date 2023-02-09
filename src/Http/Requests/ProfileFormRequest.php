<?php
namespace Pebblemark\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
            'full_name' => 'required|string',
            'contact_no' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|numeric',
            'country' => 'required|string'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Response;

class StoreUpdatePost extends Request
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

    
    public function response(array $errors)
    {
        return Response::json($errors);    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];
    }
}

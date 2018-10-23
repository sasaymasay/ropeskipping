<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class JudgeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  \Auth::user()->canDo('EDIT_JUDGES');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //$id = (isset($this->route()->parameter('judges')->id)) ? $this->route()->parameter('judges')->id : '';
        
        return [
             'name' => 'required|max:255',
             'surname' => 'required|max:255',
             'patronymic' => 'required|max:255',
             'city' => 'required|max:255',
             'rank' => 'required|max:255',
        ];
    }
}

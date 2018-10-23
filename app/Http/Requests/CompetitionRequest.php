<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompetitionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('EDIT_COMPETITIONS');;
    }
    
    protected function getValidatorInstance(){
        
        $validator = parent::getValidatorInstance();
        
        
        
        $validator->sometimes('alias','unique:competitions|max:255', function ($input){
            
          if($this->route()->hasParameter('comps')){
              $model = $this->route()->parameter('comps');
              return ($model->alias !== $input->alias) && !empty($input->alias);

          }  
            
            return !empty($input->alias);
        });
        
        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:255',
            'organizator'=>'required|max:255',
            'info'=>'required|max:200',
            'info'=>'required|max:200',
            'city'=>'required|max:200',
            'adress'=>'required|max:200',
            'place'=>'required|max:200',
        ];
    }
}

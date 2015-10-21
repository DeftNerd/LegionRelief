<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Legionnaire;

class LegionnaireRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // If we are editing a legionnaire, need to make sure
        // the user is either an admin or owns the legionnaire.
        if (Request::input('id'))
        {
            
            $legionnaire = Legionnaire::find(Request::input('id'));

            if ($legionnaires->isEditable())
            {
                return true;
            }

        // We are adding a legionnaire, so just need to make sure
        // the user is signed in.
        } else {

            return \Auth::check();            
        
        }

        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required',
            'oneline'     => 'required|max:250',
            'description' => 'required',
            'categories'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'Each legionnaire requires a descriptive name.',
            'oneline.max'         => 'The one-line description must be less than 250 characters',
            'oneline.required'     => 'Each legionnaire requires a short description.',
            'description.required' => 'Each legionnaire requires a description and accompanying code. Markdown welcomed!',
            'categories.required'  => 'Please select at least one and up to three categories'
        ];
    }
}

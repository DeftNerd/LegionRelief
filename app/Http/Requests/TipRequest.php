<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tip;

class TipRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // If we are editing a tip, need to make sure
        // the user is either an admin or owns the tip.
        if (Request::input('id'))
        {
            
            $tip = Tip::find(Request::input('id'));

            if ($tips->isEditable())
            {
                return true;
            }

        // We are adding a tip, so just need to make sure
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
            'name.required'        => 'Each tip requires a descriptive name.',
            'oneline.max'         => 'The one-line description must be less than 250 characters',
            'oneline.required'     => 'Each tip requires a short description.',
            'description.required' => 'Each tip requires a description and accompanying code. Markdown welcomed!',
            'categories.required'  => 'Please select at least one and up to three categories'
        ];
    }
}

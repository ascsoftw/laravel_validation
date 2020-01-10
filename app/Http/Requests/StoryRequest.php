<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoryRequest extends FormRequest
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
        $ignoreId = $this->route('story.id');
        
        return [
            'subject' => [
                'required', 'min:10', 'max:200',
                function ($attribute, $value, $fail) {
                    if ($value === 'Dummy Subject') {
                        $fail($attribute . ' is invalid.');
                    }
                },
                Rule::unique('stories')->ignore( $ignoreId),
            ],
            'body' => ['required', 'min:50'],
            'type' => 'required',
            'active' => 'required',
        ];
    }

    public function withValidator( $validator ) {
        $validator->sometimes('body', 'max:200', function ($input) {
            return $input->type == 'short';
        });
    }

    public function messages()
    {

        return [
            'required' => 'Please enter :attribute',
        ];
    }    
}

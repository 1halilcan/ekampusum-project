<?php

namespace App\Http\Requests\DiscussionInPagePost;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DiscussionInPagePostRequest extends FormRequest
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
        if ($this->which == 'edit') {
            return DiscussionEditRequest::getRules();
        } else if ($this->which == 'discussionNewComments') {
            return DiscussionCommentRequest::getRules();
        } else {
            return [];
        }
    }

    public function messages()
    {
        if ($this->which == 'edit') {
            return DiscussionEditRequest::getMessage();
        } else if ($this->which == 'discussionNewComments') {
            return DiscussionCommentRequest::getMessage();
        } else {
            return [];
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->first(),
                'status' => '0'
            ])
        );
    }
}

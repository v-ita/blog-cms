<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Comment,id'],
			'article_id' => ['bail', 'required', 'integer', 'exists:App\Models\Article,id'],
			'content' => ['required', 'string'],
		];

		if (auth()->guest()) {
			$rules['name'] = ['bail', 'required', 'string', 'max:255'];
			$rules['email'] = ['bail', 'required', 'string', 'email', 'max:255'];
		}

		return $rules;
	}
}
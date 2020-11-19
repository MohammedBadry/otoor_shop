<?php

namespace App\Http\Requests\Offers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Tester;
use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Validation\Rule;

class OfferRequest extends FormRequest
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
        return RuleFactory::make([
            '%name%' => ['required', 'string', 'max:255'],
            'target_id' => ['required', 'numeric'],
            'target_type' => ['required', Rule::in([Product::class, Category::class, Collection::class, Tester::class])],
            'percent' => ['required', 'numeric', 'max:100'],
            'from' => ['required'],
            'to' => ['required'],
        ]);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return RuleFactory::make(trans('offers.attributes'));
    }
}

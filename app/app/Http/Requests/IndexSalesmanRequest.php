<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Salesman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexSalesmanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $sortColumns = array_map(
            function (string $column) {
                return [$column, "-$column"];
            },
            Salesman::getOrderableColumns()
        );

        $sortColumns = array_merge(...$sortColumns);

        return [
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100',
            'sort' => [
                'string',
                Rule::in($sortColumns),
            ],
        ];
    }
}

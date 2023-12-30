<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Exceptions\InputDataBadFormatException;
use App\Http\Requests\Exceptions\InputDataOutOfRangeException;
use App\Models\RulesFactory\SalesmanRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;

class CreateSalesmanRequest extends FormRequest
{
    public function __construct(
        private SalesmanRules $salesmanRules
    ) {
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->salesmanRules->getCreateRules(stage: 1);
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $rules = $validator->failed();
                if (count($rules) > 0) {
                    $validator->setException(InputDataBadFormatException::class);
                    return;
                }

                $validator = ValidatorFacade::make(
                    $validator->getData(),
                    $this->salesmanRules->getCreateRules(stage: 2)
                );
                $validator->setException(InputDataOutOfRangeException::class);
                $validator->validate();
            }
        ];
    }
}

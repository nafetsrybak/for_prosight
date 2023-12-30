<?php

declare(strict_types=1);

namespace App\Models\RulesFactory;

use App\Models\Enum\Gender;
use App\Models\Enum\MaritalStatus;
use App\Models\Enum\TitlesAfter;
use App\Models\Enum\TitlesBefore;
use Illuminate\Validation\Rules\Enum;

class SalesmanRules
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function getCreateRules(int $stage): array
    {
        switch ($stage) {
            case 1:
                return [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'titles_before' => 'nullable|array',
                    'titles_before.*' => ['distinct', new Enum(TitlesBefore::class)],
                    'titles_after' => 'nullable|array',
                    'titles_after.*' => ['distinct', new Enum(TitlesAfter::class)],
                    'prosight_id' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'nullable|string',
                    'gender' => [
                        'required',
                        new Enum(Gender::class),
                    ],
                    'marital_status' => [
                        'nullable',
                        new Enum(MaritalStatus::class),
                    ],
                ];
            case 2:
                return [
                    'first_name' => 'min:2|max:50',
                    'last_name' => 'min:2|max:50',
                    'titles_before' => 'min:0|max:10',
                    'titles_after' => 'min:0|max:10',
                    'prosight_id' => 'min:5|max:5',
                ];
            default:
                throw new \InvalidArgumentException('Invalid stage');
        }
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function getImportRules(): array
    {
        return [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'prosight_id' => 'required|string|min:5|max:5',
            'email' => 'required|email',
            'phone' => 'required|string',
            'gender' => ['required', new Enum(Gender::class)],
            'marital_status' => ['nullable', new Enum(MaritalStatus::class)],
            'titles_before' => 'nullable|array|min:0|max:10',
            'titles_before.*' => ['distinct', new Enum(TitlesBefore::class)],
            'titles_after' => 'nullable|array|min:0|max:10',
            'titles_after.*' => ['distinct', new Enum(TitlesAfter::class)],
        ];
    }
}

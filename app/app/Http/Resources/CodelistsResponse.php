<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Enum\Gender;
use App\Models\Enum\MaritalStatus;
use App\Models\Enum\TitlesBefore;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CodelistsResponse extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $marital_statuses = [];
        foreach (MaritalStatus::cases() as $marital_status) {
            $marital_statuses[] = [
                'code' => $marital_status->value,
                'name' => [
                    Gender::M->value => $marital_status->getNameForGender(Gender::M),
                    Gender::F->value => $marital_status->getNameForGender(Gender::M),
                    'general' => $marital_status->getNameForGender(null),
                ],
            ];
        }

        $genders = [];
        foreach (Gender::cases() as $gender) {
            $genders[] = [
                'code' => $gender->value,
                'name' => $gender->getName(),
            ];
        }

        $titles_before = [];
        foreach (TitlesBefore::cases() as $title_before) {
            $titles_before[] = [
                'code' => $title_before->name,
                'name' => $title_before->value
            ];
        }

        $titles_after = [];
        foreach (TitlesBefore::cases() as $title_after) {
            $titles_after[] = [
                'code' => $title_after->name,
                'name' => $title_after->value
            ];
        }

        return [
            'marital_statuses' => $marital_statuses,
            'genders' => $genders,
            'titles_before' => $titles_before,
            'titles_after' => $titles_after,
        ];
    }
}

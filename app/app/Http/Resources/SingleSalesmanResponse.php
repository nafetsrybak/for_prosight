<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Enum\TitlesBefore;
use App\Models\Enum\TitlesAfter;

class SingleSalesmanResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \Illuminate\Support\Collection<int, TitlesBefore>|null $titles_before */
        $titles_before = $this->titles_before;

        /** @var \Illuminate\Support\Collection<int, TitlesAfter>|null $titles_after */
        $titles_after = $this->titles_after;

        $titles_before_string = '';
        if (isset($titles_before)) {
            foreach ($titles_before as $title) {
                $titles_before_string .= $title->value . ' ';
            }
            $titles_before_string = trim($titles_before_string);
        }

        $titles_after_string = '';
        if (isset($titles_after)) {
            foreach ($titles_after as $title) {
                $titles_after_string .= $title->value . ' ';
            }
            $titles_before_string = trim($titles_before_string);
        }

        return [
            'id' => $this->id,
            'self' => route('salesmen.show', ['salesman' => $this->id], false),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'display_name' => trim(
                $titles_before_string . ' ' .
                $this->first_name . ' ' .
                $this->last_name . ' ' .
                $titles_after_string
            ),
            'titles_before' => $this->titles_before,
            'titles_after' => $this->titles_after,
            'prosight_id' => $this->prosight_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

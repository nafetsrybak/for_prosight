<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Enum\Gender;
use App\Models\Enum\MaritalStatus;
use App\Models\Enum\TitlesAfter;
use App\Models\Enum\TitlesBefore;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'titles_before',
        'titles_after',
        'prosight_id',
        'email',
        'phone',
        'gender',
        'marital_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'titles_after' => AsEnumCollection::class . ':' . TitlesAfter::class,
        'titles_before' => AsEnumCollection::class . ':' . TitlesBefore::class,
        'gender' => Gender::class,
        'marital_status' => MaritalStatus::class,
    ];

    /**
     * Get the columns by which the model can be ordered.
     *
     * @return string[]
     */
    public static function getOrderableColumns(): array
    {
        return [
            'first_name',
            'last_name',
            'prosight_id',
            'created_at',
        ];
    }
}

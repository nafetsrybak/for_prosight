<?php

declare(strict_types=1);

namespace App\Models\Enum;

enum Gender: string
{
    case M = 'm';
    case F = 'f';

    public function getName(): string
    {
        return match ($this) {
            self::M => 'muž',
            self::F => 'žena',
        };
    }
}
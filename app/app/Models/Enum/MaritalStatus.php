<?php

declare(strict_types=1);

namespace App\Models\Enum;

enum MaritalStatus: string
{
    case MARRIED = 'married';
    case SINGLE = 'single';
    case DIVORCED = 'divorced';
    case WIDOWED = 'widowed';

    public function getNameForGender(?Gender $gender): string
    {
        switch ($this) {
            case self::MARRIED:
                return match ($gender) {
                    Gender::M => 'ženatý',
                    Gender::F => 'vydatá',
                    default => 'ženatý / vydatá',
                };
            case self::SINGLE:
                return match ($gender) {
                    Gender::M => 'slobodný',
                    Gender::F => 'slobodná',
                    default => 'slobodný / slobodná',
                };
            case self::DIVORCED:
                return match ($gender) {
                    Gender::M => 'rozvedený',
                    Gender::F => 'rozvedená',
                    default => 'rozvedený / rozvedená',
                };
            case self::WIDOWED:
                return match ($gender) {
                    Gender::M => 'ovdovený',
                    Gender::F => 'ovdovená',
                    default => 'ovdovený / ovdovená',
                };
            default:
                throw new \LogicException('Unknown marital status');
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Http\Requests\Exceptions;

use Illuminate\Validation\ValidationException;

class InputDataOutOfRangeException extends ValidationException
{
}

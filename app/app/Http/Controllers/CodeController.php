<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CodelistsResponse;

class CodeController extends Controller
{
    /**
     * Query for general codelists.
     */
    public function index(): CodelistsResponse
    {
        return new CodelistsResponse(null);
    }
}

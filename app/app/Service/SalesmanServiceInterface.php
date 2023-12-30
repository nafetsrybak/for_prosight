<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Salesman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SalesmanServiceInterface
{
    public function index(string $sortColumn, string $sortDirection, int $perPage): LengthAwarePaginator;
    public function createSalesman(array $data): Salesman;
    public function updateSalesman(Salesman $salesman, array $data): Salesman;
    public function deleteSalesman(Salesman $salesman): void;
}
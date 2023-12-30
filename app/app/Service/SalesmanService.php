<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Salesman;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SalesmanService implements SalesmanServiceInterface
{
    public function index(string $sortColumn, string $sortDirection, int $perPage): LengthAwarePaginator
    {
        return Salesman::orderBy($sortColumn, $sortDirection)->paginate($perPage);
    }

    /**
     * Create a new salesman.
     * 
     * @param array<mixed> $data
     */
    public function createSalesman(array $data): Salesman
    {
        $salesman = Salesman::create($data);
        $salesman->save();

        return $salesman;
    }

    /**
     * Update an existing salesman.
     * 
     * @param array<mixed> $data
     */
    public function updateSalesman(Salesman $salesman, array $data): Salesman
    {
        $salesman->update($data);

        return $salesman;
    }

    /**
     * Delete an existing salesman.
     */
    public function deleteSalesman(Salesman $salesman): void
    {
        $salesman->delete();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalesmanRequest;
use App\Http\Requests\IndexSalesmanRequest;
use App\Http\Requests\UpdateSalesmanRequest;
use App\Http\Resources\MultipleSalesmenResponse;
use App\Http\Resources\SingleSalesmanResponse;
use App\Models\Salesman;
use App\Service\SalesmanServiceInterface;
use Illuminate\Http\Response;

class SalesmanController extends Controller
{
    public function __construct(
        private SalesmanServiceInterface $salesmanService
    ) {  
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexSalesmanRequest $request): MultipleSalesmenResponse
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'] ?? 10;
        $sort = $validated['sort'] ?? 'created_at';

        $sortDirection = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $sortColumn = ltrim($sort, '-');

        $salesmen = $this->salesmanService->index($sortColumn, $sortDirection, (int) $perPage);

        return new MultipleSalesmenResponse($salesmen);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSalesmanRequest $createSalesmanRequest): SingleSalesmanResponse
    {
        $validated = $createSalesmanRequest->validated();

        $salesman = $this->salesmanService->createSalesman($validated);

        $response = new SingleSalesmanResponse($salesman);
        $response
            ->response()
            ->setStatusCode(Response::HTTP_CREATED)
        ;

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Salesman $salesman): SingleSalesmanResponse
    {
        return new SingleSalesmanResponse($salesman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Salesman $salesman, UpdateSalesmanRequest $updateSalesmanRequest): SingleSalesmanResponse
    {
        $validated = $updateSalesmanRequest->validated();
        
        $salesman = $this->salesmanService->updateSalesman($salesman, $validated);

        return new SingleSalesmanResponse($salesman);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salesman $salesman): Response
    {
        $this->salesmanService->deleteSalesman($salesman);

        return response()->noContent();
    }
}

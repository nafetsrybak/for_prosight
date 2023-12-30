<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\RulesFactory\SalesmanRules;
use App\Service\SalesmanServiceInterface;

class ImportSalesmen extends Command
{
    public function __construct(
        private SalesmanRules $salesmanRules,
        private SalesmanServiceInterface $salesmanService
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     * 
     * @var string
     */
    protected $signature = 'app:import-salesmen {file}';

    /**
     * The console command description.
     * 
     * @var string
     */
    protected $description = 'Import salesmen from csv file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $file = $this->argument('file');
        if (!Storage::exists($file)) {
            $this->error("File not found: $file");
            return;
        }

        $handle = Storage::readStream($file);
        if ($handle === false) {
            $this->error("Could not open file: $file");
            return;
        }

        // Skip the header line
        fgetcsv($handle, 0, ';');

        // Validation rules
        $rules = $this->salesmanRules->getImportRules();

        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            // Data to validate
            $salesmanData = [
                'first_name' => $data[0],
                'last_name' => $data[1],
                'titles_before' => $data[2] !== '' ? explode('|', $data[2]) : null,
                'titles_after' => $data[3] !== '' ? explode('|', $data[3]) : null,
                'prosight_id' => $data[4],
                'email' => $data[5],
                'phone' => $data[6],
                'gender' => $data[7],
                'marital_status' => $data[8] !== '' ? $data[8] : null,
            ];

            // Create the validator
            $validator = Validator::make($salesmanData, $rules);

            // Check for validation errors
            if ($validator->fails()) {
                $this->error('Invalid data found in the CSV file: ' . $validator->errors());
                continue;
            }

            // Retrieve the validated input
            $validated = $validator->validated();

            // Create the salesman
            $this->salesmanService->createSalesman($validated);
        }

        fclose($handle);

        $this->info('Salesmen imported successfully');
    }
}

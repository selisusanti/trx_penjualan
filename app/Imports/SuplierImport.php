<?php

namespace App\Imports;

use App\Models\Suplier;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;

class SuplierImport implements ToArray
{
    public function array(array $array)
    {
        $rowNumber = 0;
        $success = 0;
        $failure = 0;
        try {
            foreach ($array as $row) {
                $rowNumber++;
                if ($rowNumber < 2){
                    continue;
                }
                if (empty($row[0]) || empty($row[1]) || empty($row[2] || empty($row[3]) || empty($row[4]) || empty($row[5]))){
                    continue;
                }
                Log::info($row[0]);
                $suplier = Suplier::create([
                    'supplier_code'=> $row[1],
                    'name'=> $row[0],
                    'address'=> $row[2],
                    'pic'=> $row[3],
                    'phone_number'=> $row[4],
                    'npwp'=> $row[5],
                ]); 
                
                if ($suplier) {
                    $success++;
                } else {
                    $failure++;
                }
            }
        } catch (Exception $exception) {
            Log::error($exception);
            // Log::error($exception->getMessage());
        }
        
        $this->result = [
            'success'   => $success,
            'fail'      => $failure
        ];
    }

    public function chunkSize(): int
    {
        return 300;
    }

    public function getResult()
    {
        return $this->result;
    }
}

<?php

namespace App\Imports;

use App\Models\Product;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;

class ProductImport implements ToArray
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
                $product = Product::create([
                    'product_name'=> $row[0],
                    'code'=> $row[1],
                    'description'=> $row[2],
                    'price'=> $row[3],
                    'stock'=> $row[4],
                    'picture'=> $row[5] ?? '',
                    'suplier_id'=> $row[6],
                    'insert_by'=> auth()->user()->id,
                ]); 
                
                if ($product) {
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

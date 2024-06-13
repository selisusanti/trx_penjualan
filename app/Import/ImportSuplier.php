<?php

namespace App\Imports;

use App\Models\Suplier;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;

class ImportContract implements ToArray
{
    public function array(array $array): void
    {
        try {
            DB::beginTransaction();

            $rowNumber = 1;

            foreach ($array as $row) {

                if ($rowNumber >= 2) {
                    if (empty($row[0]) || empty($row[1]) || empty($row[2] || empty($row[3]) || empty($row[4]) || empty($row[5]))){
                        continue;
                        Log::error($rowNumber);

                    }
                    Log::info($row[0]);
                    // Suplier::query()->create([
                    //     'supplier_code'=> $row[1],
                    //     'name'=> $row[0],
                    //     'address'=> $row[2],
                    //     'pic'=> $row[3],
                    //     'phone_number'=> $row[4],
                    //     'pic'=> $row[5],
                    // ]);
                    Log::error($rowNumber);
                }
                $rowNumber++;
            }
            DB::commit();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }
    }
}

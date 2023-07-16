<?php

namespace App\Imports;

use App\Models\EmployeeAttendance;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportAttendance implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employee = Employee::where('unique_id','=', $row[12])->first();
        // if($employee){
            return new EmployeeAttendance([
                'unique_id' => $row[12],
                'in_out_time' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('Y-m-d H:i:s'),
                'MemoInfo' => $row[5],
                'WorkCode' => $row[7]
            ]);
        // }
    }
    
     /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}

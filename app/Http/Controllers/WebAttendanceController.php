<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;

class WebAttendanceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $message = "";
        $time = "";
        if($request->post()){
            $employee = Employee::where('unique_id', $request->post('unique_id'))->first();
            if(empty($employee)){
                return view('landing')->with(['error' => "Card No. is not exist", 'success'=> '','time'=>'']);
            }
            $employee_attendances = new EmployeeAttendance();
            $employee_attendances->unique_id = $request->post('unique_id');
            $employee_attendances->in_out_time = Carbon::now();
            $employee_attendances->Memoinfo = $request->post('Memoinfo');
            $employee_attendances->save();
            $message = "Attendance updated!";
            $time = "Hi, " . $employee->first_name . " " . $employee->last_name;
            $time .= " the time is: " . $employee_attendances->in_out_time;
        
        }
        return view('landing')->with(['success' => $message, 'time' => $time, 'error' => '']);
    }
}

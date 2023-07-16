<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Workshift;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
                return view('home')->with(['error' => "Card No. is not exist", 'success'=> '','time'=>'']);
            }
            $employee_attendances = new EmployeeAttendance();
            $employee_attendances->unique_id = $request->post('unique_id');
            $employee_attendances->in_out_time = Carbon::now();
            $employee_attendances->save();
            $message = "Attendance updated!";
            $time = "Hi, " . $employee->first_name . " " . $employee->last_name;
            $time .= " the time is: " . $employee_attendances->in_out_time;
        
        }
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        $late_count_time = strtotime("1/1/1980");
        if($employee){
            $workshift = Workshift::where('id',$employee->work_shift_id)->first();
            $late_count_time = strtotime("1/1/1980 $workshift->late_count_time");
        }
        
        $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, 
        MIN( `employee_attendances`.`in_out_time` ) AS `in_time`, 
        IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, 
        MAX( `employee_attendances`.`in_out_time` ), '' ) AS `out_time`, 
        DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, 
        TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, 
        CONCAT(employees.first_name,' ',employees.last_name) as name 
        FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id 
        WHERE date_format(`employee_attendances`.`in_out_time`,'%Y-%m-%d') = date_format(curdate(), '%Y-%m-%d') 
        GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name);");

        return view('home')->with(['success' => $message, 'time' => $time, 'error' => '','employee_attendances' => $employee_attendances, 'late_count_time'=>$late_count_time]);
    }
}

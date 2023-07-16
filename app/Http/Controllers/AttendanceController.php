<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshift;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAttendance;
use DB;
use Auth;

class AttendanceController extends Controller
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
    public function index()
    {
        //for filtering
        // $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, MIN( `employee_attendances`.`in_out_time` ) AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, MAX( `employee_attendances`.`in_out_time` ), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id where date_format(`hr_yleo`.`employee_attendances`.`in_out_time`,'%Y-%m-%d') = date_format(curdate(), '%Y-%m-%d') GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name);");
        $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r') AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r'), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name)  ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
        if(Auth::user()->role_id == 2){
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            $employee = Employee::where('supervisor_id',Auth::user()->id)->get();
            $employees = "'".$emp->unique_id."',";
            if($employee){
                foreach($employee as $key => $val){
                    $employees .= "'". $val->unique_id . "',";
                }
                $employees = rtrim($employees,',');
            }
            $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r') AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r'), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id WHERE employee_attendances.unique_id in ($employees) GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name)  ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
            // $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r') AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r'), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name)  ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
        }

        if(Auth::user()->role_id == 1){
            $employee = Employee::where('user_id',Auth::user()->id)->first();
            $employees = "'".$employee->unique_id."'";
            $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r') AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r'), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id WHERE employee_attendances.unique_id in ($employees) GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name)  ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
            // $employee_attendances = DB::select("SELECT `employee_attendances`.`unique_id` AS `unique_id`, DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r') AS `in_time`, IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%Y-%m-%d %r'), '' ) AS `out_time`, DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, CONCAT(employees.first_name,' ',employees.last_name) as name FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name)  ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
        }

        return view('attendance/dashboard/attendance')->with(["employee_attendances"=>$employee_attendances]);
    }   

    public function import(Request $request){
        $import = Excel::import(new ImportAttendance, $request->file('file')->store('files'));
        $error = null;
        $success = null;
        // if($import){
        //     $success = "Import success!";
        // }else{
        //     $error = "Card numbers needs to register first.";
        // }

        return redirect()->back()->with(["error"=> $error, 'success'=>$success]);
    }

    public function workshifts()
    {
        $workshifts = Workshift::all();

        return view('attendance/workshifts/workshifts')->with(['workshifts'=>$workshifts,'message'=>'']);
    }

    public function addEditWorkshift(Request $request)
    {
        $message = "";
        if($request->post()){
            $workshifts = new Workshift();
            foreach($request->post() as $key => $value){
                if($key == "_token") continue;
                $workshifts->{$key} = $value;
            }
            $workshifts->save();
            if($workshifts){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('attendance/workshifts/add-edit-workshifts')->with('success',$message);
    }

    public function deleteWorkshift($id)
    {
        Workshift::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }
}

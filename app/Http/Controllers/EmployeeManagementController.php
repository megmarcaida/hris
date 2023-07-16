<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use App\Models\Workshift;
use App\Models\Deduction;
use App\Models\Credit;
use App\Models\DeductionValue;
use App\Models\CreditValue;
use Illuminate\Support\Facades\Hash;
use Auth;

class EmployeeManagementController extends Controller
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
        $employees = Employee::with(['user.roles','department','branch','designation'])->get();
        $user_id = Auth::user()->id;
        if(Auth::user()->role_id == 2){
            $employees = Employee::where('supervisor_id', $user_id)->with(['user.roles','department','branch','designation'])->get();
        }
        
        return view('employee_management/manage_employee/manage_employee')->with([
            'employees'=>$employees,'message'=>'']);
    }

    public function addEmployee(Request $request)
    {
        $message = "";
        $user_tbl = array("username","email","role_id","password","confirm_password");
        if($request->post()){
            $employee = new Employee();

            $deductions = Deduction::all();
            $credits = Credit::all();
            foreach($deductions as $deduction){
                array_push($user_tbl,'deduction_id_'.$deduction->id);
                array_push($user_tbl,'deduction_'.\Str::slug(str_replace('-','',$deduction->name)));
            }
            foreach($credits as $credit){
                array_push($user_tbl,'credit_id_'.$credit->id);
                array_push($user_tbl,'credit_'.\Str::slug(str_replace('-','',$credit->name)));
            }

            $data['name'] = $request->post('username');
            $data['email'] = $request->post('email');
            $data['password'] = $request->post('first_name') . $request->post('last_name')."123";

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $request->post('role_id'),
            ]);
            


            foreach($request->post() as $key => $value){
                if(in_array($key,$user_tbl)){
                    continue;
                }

                if($key == "_token") continue;

                if ($key == "rest_day") {
                    $rest_day = '';
                    foreach($value as $r => $rv){
                        if($r == 0){
                            $rest_day .= $rv;
                        } else {
                            $rest_day .= "," . $rv; 
                        }
                    }
                    $employee->{$key} = $rest_day;
                } else {
                    $employee->{$key} = $value;
                }
            }
            $employee->user_id = $user->id;
            $employee->permanent_status = 1;
            $employee->created_by = Auth::user()->id;
            $employee->updated_by = Auth::user()->id;
            $employee->save();
            if($employee){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }

            //add deductions
            // foreach($deductions as $dv){
            //     if($request->post('deduction_id_'.$dv->id)){
            //         $deduction_value = new DeductionValue();
            //         $deduction_value->employee_id = $employee->id;
            //         $deduction_value->deduction_id = $request->post('deduction_id_'.$dv->id);
            //         $deduction_value->field_name = 'deduction_'.\Str::slug(str_replace('-','',$dv->name));
            //         $deduction_value->value = $request->post('deduction_'.\Str::slug(str_replace('-','',$dv->name)));
            //         $deduction_value->type = $dv->type;
            //         $deduction_value->tax = $dv->tax;
            //         $deduction_value->save();
            //     }
            // }
            //add credits
            // foreach($credits as $cv){
            //     if($request->post('credit_id_'.$cv->id)){
            //         $credit_value = new CreditValue();
            //         $credit_value->employee_id = $employee->id;
            //         $credit_value->credit_id = $request->post('credit_id_'.$cv->id);
            //         $credit_value->field_name = 'credit_'.\Str::slug(str_replace('-','',$cv->name));
            //         $credit_value->value = $request->post('credit_'.\Str::slug(str_replace('-','',$cv->name)));
            //         $credit_value->type = $cv->type;
            //         $credit_value->tax = $cv->tax;
            //         $credit_value->save();
            //     }
            // }
        }

        $roles = Role::all();      
        $departments = Department::all();
        $designations = Designation::all();
        $branches = Branch::all();
        $workshifts = Workshift::all();
        $users = User::all();    
        $deductions = Deduction::all();
        $credits = Credit::all();

        return view('employee_management/manage_employee/add-manage_employee')->with([
            'roles'=>$roles,
            'departments'=>$departments,
            'designations'=>$designations,
            'branches'=>$branches,
            'workshifts'=>$workshifts,
            'success'=>$message,
            'users'=>$users,
            'user_id'=>Auth::user()->id,
            'deductions'=>$deductions,
            'credits'=>$credits
        ]);
    }

    public function editEmployee(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $employee = Employee::find($id);
        
        $deductions = Deduction::all();
        $credits = Credit::all();

        if($employee){
            $getUser = User::find($employee->user_id);
        }
        
        $user_tbl = array("username","email","role_id","password","confirm_password");
        foreach($deductions as $deduction){
            array_push($user_tbl,'deduction_id_'.$deduction->id);
            array_push($user_tbl,'deduction_'.\Str::slug(str_replace('-','',$deduction->name)));
        }
        foreach($credits as $credit){
            array_push($user_tbl,'credit_id_'.$credit->id);
            array_push($user_tbl,'credit_'.\Str::slug(str_replace('-','',$credit->name)));
        }
        
        if($request->post()){
            $employee = Employee::find($id);
            if($employee){
                $user = User::find($employee->user_id);
                $user->name = $request->post('first_name') . $request->post('last_name');
                $user->role_id = $request->post('role_id');
                $user->email = $request->post('email');
                if(!empty($request->post('password'))){
                    $user->password = Hash::make($request->post('password'));
                }
                $user->save();
            }
            foreach($request->post() as $key => $value){
                if(in_array($key,$user_tbl)){
                    continue;
                }

                if($key == "_token") continue;

                if ($key == "rest_day") {
                    $rest_day = '';
                    foreach($value as $r => $rv){
                        if($r == 0){
                            $rest_day .= $rv;
                        } else {
                            $rest_day .= "," . $rv; 
                        }
                    }
                    $employee->{$key} = $rest_day;
                } else {
                    $employee->{$key} = $value;
                }
            }
            $employee->updated_by = Auth::user()->id;
            $employee->save();
            if($employee){
                $message = "Successfully updated.";
            }else{
                $message = "Failed to save";
            }

            //delete deductions
            $deduction_value = DeductionValue::where('employee_id',$id);
            if($deduction_value){
                $deduction_value->delete();
            }
            //add deductions
            foreach($deductions as $dv){
                if($request->post('deduction_id_'.$dv->id)){
                    $deduction_value = new DeductionValue();
                    $deduction_value->employee_id = $id;
                    $deduction_value->deduction_id = $request->post('deduction_id_'.$dv->id);
                    $deduction_value->field_name = 'deduction_'.\Str::slug(str_replace('-','',$dv->name));
                    $deduction_value->value = $request->post('deduction_'.\Str::slug(str_replace('-','',$dv->name)));
                    $deduction_value->type = $dv->type;
                    $deduction_value->tax = $dv->tax;
                    $deduction_value->save();
                }
            }

            //delete credits
            $credit_value = CreditValue::where('employee_id',$id);
            if($credit_value){
                $credit_value->delete();
            }
            //add credits
            foreach($credits as $cv){
                if($request->post('credit_id_'.$cv->id)){
                    $credit_value = new CreditValue();
                    $credit_value->employee_id = $id;
                    $credit_value->credit_id = $request->post('credit_id_'.$cv->id);
                    $credit_value->field_name = 'credit_'.\Str::slug(str_replace('-','',$cv->name));
                    $credit_value->value = $request->post('credit_'.\Str::slug(str_replace('-','',$cv->name)));
                    $credit_value->type = $cv->type;
                    $credit_value->tax = $cv->tax;
                    $credit_value->save();
                }
            }
        }

        $roles = Role::all();      
        $departments = Department::all();
        $designations = Designation::all();
        $branches = Branch::all();
        $workshifts = Workshift::all();
        $users = User::all();  
        $credit_value = CreditValue::where('employee_id', $id)->get();  
        $deduction_value = DeductionValue::where('employee_id', $id)->get();  
        $rd = explode(",",$employee->rest_day);
        
        return view('employee_management/manage_employee/edit-manage_employee')->with([
            'roles'=>$roles,
            'departments'=>$departments,
            'designations'=>$designations,
            'branches'=>$branches,
            'workshifts'=>$workshifts,
            'success'=>$message,
            'users'=>$users,
            'user_id'=>Auth::user()->id,
            'employee'=>$employee,
            'get_user'=>$getUser,
            'deductions'=>$deductions,
            'credits'=>$credits,
            'deduction_values' => $deduction_value,
            'credit_values' => $credit_value,
            'rest_day' => $rd
        ]);
    }

    

    public function deleteEmployee($id)
    {
        $employee =  Employee::where('id',$id)->first();
        User::where('id',$employee->user_id)->delete();
        Employee::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }

    public function department()
    {
        $departments = Department::all();

        return view('employee_management/department/department')->with(['departments'=>$departments,'message'=>'']);
    }

    public function addDepartment(Request $request)
    {
        $message = "";
        if($request->post()){
            $department = new Department();
            $department->name = $request->post('name');
            $department->save();
            if($department){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('employee_management/department/add-department')->with('success',$message);
    }

    public function editDepartment(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $department = Department::find($id);
        if($department) {
            if($request->post()){
                $department->name = $request->post('name');
                $department->save();
                if($department){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('employee_management/department/edit-department')->with(['success'=>$message,'department'=>$department]);
        }

        return redirect()->route('em/department'); 
    }

    public function deleteDepartment($id)
    {
        $department = Department::where('id',$id);
        $checkIfExist = Employee::where('department_id',$id)->count();
        $message = null;
        $error = null;
        if($checkIfExist == 0){
            $department->delete();
            $message = "Successfully delete.";
        }else{
            $error = "Cannot delete, department is currently used.";
        }
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    public function designation()
    {
        $designations = Designation::all();
        return view('employee_management/designation/designation')->with(['designations'=>$designations,'message'=>'']);
    }

    public function addDesignation(Request $request)
    {
        $message = "";
        if($request->post()){
            $designation = new Designation();
            $designation->name = $request->post('name');
            $designation->save();
            if($designation){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('employee_management/designation/add-designation')->with('success',$message);
    }

    public function editDesignation(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $designation = Designation::find($id);
        if($designation) {
            if($request->post()){
                $designation->name = $request->post('name');
                $designation->save();
                if($designation){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('employee_management/designation/edit-designation')->with(['success'=>$message,'designation'=>$designation]);
        }

        return redirect()->route('em/designation'); 
    }

    public function deleteDesignation($id)
    {
        $designation = Designation::where('id',$id);
        $checkIfExist = Employee::where('designation_id',$id)->count();
        $message = null;
        $error = null;
        if($checkIfExist == 0){
            $designation->delete();
            $message = "Successfully delete.";
        }else{
            $error = "Cannot delete, designation is currently used.";
        }
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    public function branch()
    {
        $branch = Branch::all();
        return view('employee_management/branch/branch')->with(['branches'=>$branch,'message'=>'']);
    }

    public function addBranch(Request $request)
    {
        $message = "";
        if($request->post()){
            $branch = new Branch();
            $branch->name = $request->post('name');
            $branch->save();
            if($branch){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('employee_management/branch/add-branch')->with('success',$message);
    }

    public function editBranch(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $branch = Branch::find($id);
        if($branch) {
            if($request->post()){
                $branch->name = $request->post('name');
                $branch->save();
                if($branch){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('employee_management/branch/edit-branch')->with(['success'=>$message,'branch'=>$branch]);
        }

        return redirect()->route('em/branch'); 
    }

    public function deleteBranch($id)
    {
        $branch = Branch::where('id',$id);
        $checkIfExist = Employee::where('branch_id',$id)->count();
        $message = null;
        $error = null;
        if($checkIfExist == 0){
            $branch->delete();
            $message = "Successfully delete.";
        }else{
            $error = "Cannot delete, branch is currently used.";
        }
        
        return back()->with(["success" => $message, "error"=>$error]);


    }

    public function termination()
    {
        return view('employee_management/termination');
    }

    public function warning()
    {
        return view('employee_management/warning');
    }

    public function promotion()
    {
        return view('employee_management/promotion');
    }
}

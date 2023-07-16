<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManualPayslip;
use App\Models\Deduction;
use App\Models\Credit;
use App\Models\Holidays;
use App\Models\Employee;
use App\Models\GeneratedPayslips;
use App\Models\RangeTables;
use App\Models\Workshift;
use App\Models\LeaveApplication;
use App\Models\OvertimeApplication;
use App\Models\MissingAttendance;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeDeduction;
use App\Models\EmployeeCredit;
use PDF;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use DB;
use Auth;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayrollReportExport;

class PayrollController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $manual_payslips = ManualPayslip::all();
        return view('payroll/manual_payslip/manual_payslip')->with(['manual_payslips'=>$manual_payslips,'message'=>'']);
    }


    public function addManualPayslip(Request $request)
    {
        $message = "";
        if($request->post()){
            $manual_payslip = new ManualPayslip();
            $message = "Attendance updated!";

            foreach($request->post() as $key => $value){

                if($key == "_token") continue;

                $manual_payslip->{$key} = $value;
            }
            $manual_payslip->save();

            if($manual_payslip){
                $message = "Successfully updated.";
                $this->sendManualPayslip($manual_payslip->id);
            }else{
                $message = "Failed to save";
            }
        
        }
        return view('payroll/manual_payslip/add-manual_payslip')->with(['success' => $message]);
    }

    public function editManualPayslip(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $manual_payslip = ManualPayslip::find($id);
        if($manual_payslip) {
            if($request->post()){
                foreach($request->post() as $key => $value){

                    if($key == "_token") continue;
    
                    $manual_payslip->{$key} = $value;
                }
                $manual_payslip->save();
                if($manual_payslip){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('payroll/manual_payslip/edit-manual_payslip')->with(['success'=>$message,'manual_payslip'=>$manual_payslip]);
        }

        return redirect()->route('payroll/manual_payslip'); 
    }

    public function deleteManualPayslip($id)
    {
        ManualPayslip::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }

    public function generateManualPayslip($id){
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $manual_payslip = ManualPayslip::find($id)->toArray();
          
        $pdf = PDF::loadView('pdf/manual_payslip', $manual_payslip);
    
        return $pdf->download($manual_payslip['name'].'_'.$manual_payslip['cut_off_date'].'.pdf');
    }

    public function sendManualPayslip($id){
        require base_path("vendor/autoload.php");

        $manual_payslip = ManualPayslip::find($id)->toArray();
        $pdf = PDF::loadView('pdf/manual_payslip', $manual_payslip);
        $mail = new PHPMailer(true);  

        // Email server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';             //  smtp host
        $mail->SMTPAuth = true;
        $mail->Username = 'hryoungliving2023dev@gmail.com';//'hryleo@makopa.online';   //  sender username
        $mail->Password = 'mgvdqpwagvmuywww';//'V99f!8MiU8jY';//'hryleo@admin';       // sender password
        $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
        $mail->Port = 465;                          // port - 587/465

        $mail->setFrom('hryleo@makopa.online', 'HR Young Living Essential Oil');
        $mail->addAddress($manual_payslip['email_address']);
        // $mail->addCC($request->emailCc);
        // $mail->addBCC($request->emailBcc);

        $mail->addReplyTo('hryleo@makopa.online', 'HR Young Living Essential Oil');

        $filename = $manual_payslip['name'].'_'.$manual_payslip['cut_off_date'].'.pdf'  ;
        $encoding = 'base64';
        $type = 'application/pdf';

        // $mail->addStringAttachment($pdf->output(),$filename,$encoding,$type);
        $mail->addStringAttachment($pdf->output(), $manual_payslip['name'].'_'.$manual_payslip['cut_off_date'].'.pdf');
        
        $mail->isHTML(true);                // Set email content format to HTML

        $mail->Subject = "Payslip ". $manual_payslip['name'].' - '.$manual_payslip['cut_off_date'];
        $mail->Body    = "test";

        // $mail->AltBody = plain text version of email body;
     
        if( !$mail->send() ) {
            return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
        }else {
            return back()->with("success", "Email has been sent.");
        }
    }

    //deductions
    public function deduction()
    {
        $deduction = Deduction::all();

        return view('payroll/deduction/deduction')->with(['deductions'=>$deduction,'message'=>'']);
    }

    public function addDeduction(Request $request)
    {
        $message = "";
        if($request->post()){
            $deduction = new Deduction();
            $deduction->name = $request->post('name');
            $deduction->type = $request->post('type');
            $deduction->tax = $request->post('tax');
            $deduction->save();
            if($deduction){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('payroll/deduction/add-deduction')->with('success',$message);
    }

    public function editDeduction(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $deduction = Deduction::find($id);
        if($deduction) {
            if($request->post()){
                $deduction->name = $request->post('name');
                $deduction->type = $request->post('type');
                $deduction->tax = $request->post('tax');
                $deduction->save();
                if($deduction){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('payroll/deduction/edit-deduction')->with(['success'=>$message,'deduction'=>$deduction]);
        }

        return redirect()->route('payroll/deduction'); 
    }

    public function deleteDeduction($id)
    {
        $deduction = Deduction::where('id',$id);
        $message = null;
        $error = null;
        $deduction->delete();
        $message = "Successfully delete.";
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    public function rangeTableDeduction(Request $request, $id = 0)
    {
        $message = "";
        $deduction = Deduction::find($id);
        $rangetable = RangeTables::where('deduction_credit_id', $id)->orderBy('id','desc')->get();
        if($rangetable) {
            if($request->post()){

                $rangetable = RangeTables::find($request->post('range_table_id'));
                if(!$rangetable){
                    $rangetable = new RangeTables();
                }

                $rangetable->deduction_credit_id = $request->post('id');
                $rangetable->name = $request->post('name');
                $rangetable->type = $request->post('type');
                $rangetable->bracket = $request->post('bracket');
                $rangetable->from = $request->post('from');
                $rangetable->to = $request->post('to');
                $rangetable->type = "-";
                $rangetable->percentage = $request->post('percentage');
                $rangetable->fixed_tax = $request->post('fixed_tax');
                $rangetable->save();
                if($rangetable){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
                return redirect('payroll/range-table-deduction/'.$request->post('id'))->with(['success'=>$message,'rangetable'=>$rangetable, 'deduction'=>$deduction]);
            }

            return view('payroll/deduction/range-table-deduction')->with(['success'=>$message,'rangetable'=>$rangetable, 'deduction'=>$deduction]);
        }

        return redirect()->route('payroll/deduction'); 
    }

    //credits
    public function credit()
    {
        $credit = Credit::all();

        return view('payroll/credit/credit')->with(['credits'=>$credit,'message'=>'']);
    }

    public function addCredit(Request $request)
    {
        $message = "";
        if($request->post()){
            $credit = new Credit();
            $credit->name = $request->post('name');
            $credit->type = $request->post('type');
            $credit->tax = $request->post('tax');
            $credit->save();
            if($credit){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('payroll/credit/add-credit')->with('success',$message);
    }

    public function editCredit(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $credit = Credit::find($id);
        if($credit) {
            if($request->post()){
                $credit->name = $request->post('name');
                $credit->type = $request->post('type');
                $credit->tax = $request->post('tax');
                $credit->save();
                if($credit){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('payroll/credit/edit-credit')->with(['success'=>$message,'credit'=>$credit]);
        }

        return redirect()->route('payroll/credit'); 
    }

    public function deleteCredit($id)
    {
        $credit = Credit::where('id',$id);
        $message = null;
        $error = null;
        $credit->delete();
        $message = "Successfully delete.";
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    //holidays
    public function holidays()
    {
        $holidays = Holidays::all();

        return view('payroll/holidays/holidays')->with(['holidays'=>$holidays,'message'=>'']);
    }

    public function addHolidays(Request $request)
    {
        $message = "";
        if($request->post()){
            $holidays = new Holidays();
            $holidays->name = $request->post('name');
            $holidays->value = $request->post('value');
            $holidays->date = $request->post('date');
            $holidays->save();
            if($holidays){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('payroll/holidays/add-holidays')->with('success',$message);
    }

    public function editHolidays(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $holidays = Holidays::find($id);
        if($holidays) {
            if($request->post()){
                $holidays->name = $request->post('name');
                $holidays->value = $request->post('value');
                $holidays->date = $request->post('date');
                $holidays->save();
                if($holidays){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('payroll/holidays/edit-holidays')->with(['success'=>$message,'holidays'=>$holidays]);
        }

        return redirect()->route('payroll/holidays'); 
    }

    public function deleteHolidays($id)
    {
        $credit = Holidays::where('id',$id);
        $message = null;
        $error = null;
        $credit->delete();
        $message = "Successfully delete.";
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    //generated payslips
    public function generatedPayslips()
    {
        $generated_payslips = GeneratedPayslips::all();

        return view('payroll/generated_payslips/generated_payslips')->with(['generated_payslips'=>$generated_payslips,'message'=>'']);
    }

    public function addGeneratedPayslips(Request $request)
    {
        $message = "";
        $employee_attendances = "";
        $employees = Employee::get();
        
        if($request->post()){
            
            $from_date = $request->post('from');
            $to_date = $request->post('to');
            $deduction_taxable = Deduction::where('tax', 'TX')->get();
            $deduction_non_taxable = Deduction::where('tax', 'NTX')->get();
            $holidays = Holidays::get();
            if($request->post('employee_id')){
                $employees = Employee::where('id', $request->post('employee_id'))->get();
            }
            foreach($employees as $key => $value){
                
                $workshift = Workshift::find($value->work_shift_id);
                $employee_attendances = DB::select(
                    "SELECT `employee_attendances`.`unique_id` AS `unique_id`, 
                    DATE_FORMAT(MIN( `employee_attendances`.`in_out_time` ),'%h:%i:%s') AS `in_time`, 
                    IF( COUNT( `employee_attendances`.`in_out_time` ) > 1, DATE_FORMAT(MAX( `employee_attendances`.`in_out_time` ),'%H:%i:%s'), '' ) AS `out_time`, 
                    DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ) AS `date`, 
                    TIMEDIFF( MAX( `employee_attendances`.`in_out_time` ), MIN( `employee_attendances`.`in_out_time` ) ) AS `working_time`, 
                    CONCAT(employees.first_name,' ',employees.last_name) as name 
                    FROM `employee_attendances` LEFT JOIN employees on employees.unique_id = employee_attendances.unique_id 
                    WHERE DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d') BETWEEN '$from_date' AND '$to_date' 
                    AND `employee_attendances`.`unique_id` = '$value->unique_id'
                    GROUP BY DATE_FORMAT( `employee_attendances`.`in_out_time`, '%Y-%m-%d' ), `employee_attendances`.`unique_id`, CONCAT(employees.first_name,' ',employees.last_name) ORDER BY MIN( `employee_attendances`.`in_out_time` ) DESC;");
                
                $basic_pay = $value->salary_id;
                $hourly_rate = (($basic_pay * 12)/261)/8;
                $rate_per_min = ((($basic_pay*2) * 12)/261)/480;
                
                $rest_day = explode(',',$value->rest_day);
                //get all working dates
                $workingDates = $this->number_of_working_days_date($request->post('from'),$request->post('to'));
                $date_present = [];
                $holiday_dates = [];

                $total_hours_present = 0;
                $working_time_in_decimal = 0;

                //lates or tardiness computation
                $total_lates = 0;
                foreach($employee_attendances as $k => $v){

                    if($workshift->name == "Flexible"){
                        $flex_to = Carbon::createFromFormat('H:i:s', $v->in_time);
                        $flex_from = Carbon::createFromFormat('H:i:s', $v->out_time);
                        $flex_diff_in_min = $flex_to->diffInMinutes($flex_from);
                        if($flex_diff_in_min > 480) {
                            continue;
                        }
                        $total_lates += 480 - $flex_diff_in_min;
                        continue;
                    }

                    if( $v->in_time > $workshift->late_count_time){
                        $to = Carbon::createFromFormat('H:i:s', $v->in_time);
                        $from = Carbon::createFromFormat('H:i', $workshift->late_count_time);
                  
                        $diff_in_min = $to->diffInMinutes($from);
                               
                        $total_lates += $diff_in_min;
                    }
                    $working_time_in_decimal = $this->hourstodecimal($v->working_time);
                    $total_hours_present += $working_time_in_decimal;
                    array_push($date_present, $v->date);
                }
                $total_lates_amount = $total_lates * $rate_per_min;

                //absences
                $total_day_absent = 0;

                //holidays
                foreach($holidays as $h_k => $hv){ 
                    array_push($holiday_dates, $hv->date);
                }
                
                foreach($workingDates as $wk => $wv){
                    if(in_array(date('D',strtotime($wv)),$rest_day)){
                        continue;
                    }
                    $leave_approved = LeaveApplication::where('employee_no', $value->employee_no)->whereBetween(DB::raw("'$wv'"),[DB::raw('`from`'), DB::raw('`to`')])->where('status','Approved')->first();
                    $missing_attendance = MissingAttendance::where('employee_no', $value->employee_no)->where('date',$wv)->where('status','Approved')->first();
                    if($leave_approved || $missing_attendance){
                        continue;
                    }

                    if(!in_array($wv, $date_present) && !in_array($wv, $holiday_dates)){
                        $total_day_absent += 1;
                    }
                }
                
                $total_day_absent_amount =  ((($basic_pay*2) * 12)/261) * $total_day_absent;
                $total_day_present = count($date_present);
                
                //overtime computation
                $regular_ot = 0;
                $rest_day_ot = 0;
                $rest_day_pay = 0;

                $regular_holiday_ot = 0;
                $rest_day_holiday_ot = 0;
                $rest_day_holiday_pay = 0;
                
                $total_ot_hours = 0;
                foreach($employee_attendances as $k => $v){
                    if( $v->out_time > $workshift->end_time){
                        $to_ot = Carbon::createFromFormat('H:i:s',  $v->out_time);
                        $from_ot = Carbon::createFromFormat('H:i', $workshift->end_time);
                        $diff_in_min_ot = $to_ot->diffInMinutes($from_ot);
                        $overtime_approved = OvertimeApplication::where('employee_no', $value->employee_no)->where('date',$v->date)->where('status','Approved')->first();
                        if($overtime_approved){
                            if($overtime_approved->no_of_hours > $diff_in_min){
                                $diff_in_min_ot = $diff_in_min;
                            }else{
                                $diff_in_min_ot = $overtime_approved->no_of_hours;
                            }
                            
                            $total_ot_hours += $diff_in_min_ot;
                            if(in_array(date('D',strtotime($v->date)),$rest_day)){
                                $rest_day_ot += (((number_format($diff_in_min_ot / 60,2)) * $hourly_rate) * (169/100));
                            } else {
                                $regular_ot += (((number_format($diff_in_min_ot / 60,2)) * $hourly_rate) * (125/100));
                            }
                        }
                    } 

                    if(in_array(date('D',strtotime($v->date)),$rest_day)){
                        if($v->out_time > $workshift->end_time){
                            $out_time = Carbon::createFromFormat('H:i',  $workshift->end_time);
                        }else{
                            $out_time = Carbon::createFromFormat('H:i:s',  $v->out_time);
                        }
                        $in_time = Carbon::createFromFormat('H:i:s', $v->in_time);
                        $diff_in_min = $out_time->diffInMinutes($in_time);
                        $overtime_approved = OvertimeApplication::where('employee_no', $value->employee_no)->where('date',$v->date)->where('status','Approved')->first();
                        if($overtime_approved){
                            if($overtime_approved->no_of_hours > $diff_in_min){
                                $diff_in_min = $diff_in_min;
                            }else{
                                $diff_in_min = $overtime_approved->no_of_hours;
                            }
                            
                            
                            $rest_day_pay += (((number_format($diff_in_min / 60,2)) * $hourly_rate) * (130/100));
                            $total_ot_hours += $diff_in_min;
                        }
                    }
                    
                    foreach($holidays as $holiday_k => $holiday_v){ 
                        if($holiday_v->date == $v->date){

                            $to_ot = Carbon::createFromFormat('H:i:s',  $v->out_time);
                            $from_ot = Carbon::createFromFormat('H:i', $workshift->end_time);
                            $diff_in_min_ot = $to_ot->diffInMinutes($from_ot);
                            if(in_array(date('D',strtotime($v->date)),$rest_day)){
                                $rest_day_holiday_ot += (((number_format($diff_in_min_ot / 60,2)) * $hourly_rate) * ($holiday_v->value/100));
                            } else {
                                $regular_holiday_ot += (((number_format($diff_in_min_ot / 60,2)) * $hourly_rate) * ($holiday_v->value/100));
                            }

                            if(in_array(date('D',strtotime($v->date)),$rest_day)){
                                $out_time = Carbon::createFromFormat('H:i',  ($v->out_time > $workshift->end_time ? $workshift->end_time : $v->out_time));
                                $in_time = Carbon::createFromFormat('H:i:s', $v->in_time);
                                $diff_in_min = $out_time->diffInMinutes($in_time);
                                $overtime_approved = OvertimeApplication::where('employee_no', $value->employee_no)->where('date',$v->date)->where('status','Approved')->first();
                                if($overtime_approved){
                                    if($overtime_approved->no_of_hours > $diff_in_min){
                                        $diff_in_min = $diff_in_min;
                                    }else{
                                        $diff_in_min = $overtime_approved->no_of_hours;
                                    }

                                    $rest_day_holiday_pay += (((number_format($diff_in_min / 60,2)) * $hourly_rate) * ($holiday_v->value/100));
                                }
                                
                            }
                        }
                    }
                }
                //end overtime computation

                //overtime and restday pay
                $regular_ot = $regular_holiday_ot > 0 ? $regular_holiday_ot : $regular_ot;
                $rest_day_ot = $rest_day_holiday_ot > 0 ? $rest_day_holiday_ot : $rest_day_ot;
                $rest_day_pay = $rest_day_holiday_pay > 0 ? $rest_day_holiday_pay : $rest_day_pay;

                //taxable income
                $overtime_pay = $regular_ot + $rest_day_ot + $rest_day_pay;
                $allowance = 0;
                $thirteen_mo_pay_tx = 0;
                $salary_adjustment = 0;
                $leave_conversion = 0;
                $lates_and_absences = $total_lates_amount + $total_day_absent_amount;
                $gross_tax_income = $basic_pay + $overtime_pay + $allowance + $thirteen_mo_pay_tx + $salary_adjustment + $leave_conversion + (-$lates_and_absences);
                
                //non-tax income
                $thirteen_mo_pay_ntx = 0;
                $mobile_subsidies = 0;
                $reimbursement = 0;
                $fleet_card = 0;
                $sickness_benefits = 0;
                $gross_non_tax_income = $thirteen_mo_pay_ntx + $mobile_subsidies + $reimbursement + $fleet_card + $sickness_benefits;

                //gross pay
                $gross_pay = $gross_tax_income + $gross_non_tax_income;
                
                //tax computation
                $withholding_tax = 0;
                foreach($deduction_taxable as $ded_k => $ded_val){
                    $rangetable = RangeTables::where('deduction_credit_id',$ded_val->id)->get();
                    foreach($rangetable as $range_key => $range_val){
                        if($gross_tax_income >= $range_val->from && $basic_pay <= $range_val->to){
                            $withholding_tax += (($gross_tax_income - $range_val->from) * ($range_val->percentage / 100)) + $range_val->fixed_tax;
                        }
                    }
                }

                
                $deductions = 0;
                $hdmf = 0;
                $sss = 0;
                $philhealth = 0;
                foreach($deduction_non_taxable as $ded_ntx_k => $ded_ntx_val){
                    $rangetable = RangeTables::where('deduction_credit_id',$ded_ntx_val->id)->get();

                    if($ded_ntx_val->id == 2){
                        foreach($rangetable as $range_key => $range_val){
                            if($basic_pay >= $range_val->from && $basic_pay <= $range_val->to){
                                $hdmf = $range_val->fixed_tax ? $range_val->fixed_tax : 0;
                                $deductions += $hdmf;
                            }
                        }
                    }

                    if($ded_ntx_val->id == 3){
                        foreach($rangetable as $range_key => $range_val){
                            if($basic_pay >= $range_val->from && $basic_pay <= $range_val->to){
                                $philhealth = ($basic_pay * ($range_val->percentage / 100));
                                $deductions += $philhealth; //$range_val->fixed_tax ? $range_val->fixed_tax : 0;
                            }
                        }
                    }

                    if($ded_ntx_val->id == 4){
                        foreach($rangetable as $range_key => $range_val){
                            if($basic_pay >= $range_val->from && $basic_pay <= $range_val->to){
                                $sss = $range_val->fixed_tax ? $range_val->fixed_tax : 0;
                                $deductions += $sss;
                            }
                        }
                    }
                }

                
                $from_timestamp = strtotime($from_date);
                $to_timestamp = strtotime($to_date);
                $date_from_day   = date("d", $from_timestamp);
                $date_to_day   = date("d", $to_timestamp);
                $hasDeduction = $date_from_day == 1 && $date_to_day == 15 ? false : true;

                //loans and credits
                $sss_loan = 0;
                $hdmf_loan = 0;
                $other_deduction = 0;
                $other_credit = 0;
                $employee_deduction = EmployeeDeduction::with('deduction')->where('employee_id', $value->id)->get();
                foreach($employee_deduction as $emp_deduction) {
                    if ($date_from_day == $emp_deduction->date && $emp_deduction->deduction->name == "SSS Loan" && $emp_deduction->due_date > $from_date) {
                        $sss_loan += ($emp_deduction->amount > 0 ?  ($emp_deduction->amount / $emp_deduction->terms) : 0);
                    }

                    if ($date_from_day == $emp_deduction->date && $emp_deduction->deduction->name == "HDMF Loan" && $emp_deduction->due_date > $from_date) {
                        $hdmf_loan += ($emp_deduction->amount > 0 ?  ($emp_deduction->amount / $emp_deduction->terms) : 0);
                    }

                    if ($date_from_day == $emp_deduction->date && $emp_deduction->deduction->name == "Other Deduction" && $emp_deduction->due_date > $from_date) {
                        $other_deduction += ($emp_deduction->amount > 0 ?  ($emp_deduction->amount / $emp_deduction->terms) : 0);
                    }
                }

                $employee_credit = EmployeeCredit::with('credits')->where('employee_id', $value->id)->get();
                foreach($employee_credit as $emp_credit) {
                    if ($from == $emp_credit->date && $emp_deduction->deduction->name == "Allowance") {
                        $allowance += $emp_credit->amount > 0;
                    }

                    if ($from == $emp_credit->date && $emp_deduction->deduction->name == "Other Credit") {
                        $other_credit += $emp_credit->amount > 0;
                    }
                }

                
                //total deduction
                $total_deductions = $withholding_tax + $deductions + $other_deduction + $hdmf_loan + $sss_loan;
                $net_pay = $gross_pay - $total_deductions;
                
                
                $thirteen_month_pay = 0;
                $sick_leave_conversion = 0;
                

                //save generated payslip
                $generated_payslip = new GeneratedPayslips();
                $generated_payslip->employee_id = $value->id;
                $generated_payslip->month_of_salary = $from_date . ' to ' . $to_date;
                $generated_payslip->from_date= $from_date;
                $generated_payslip->to_date = $to_date;
                $generated_payslip->basic_salary = $basic_pay;
                $generated_payslip->total_allowance = $allowance;
                $generated_payslip->total_deduction = $total_deductions;
                $generated_payslip->total_late = $total_lates;
                $generated_payslip->total_late_amount = $total_lates_amount;
                $generated_payslip->total_absence = $total_day_absent;
                $generated_payslip->total_absence_amount = $total_day_absent_amount;
                $generated_payslip->overtime_rate = $hourly_rate;
                $generated_payslip->total_over_time_hour = $total_ot_hours;
                $generated_payslip->total_overtime_amount = $overtime_pay;
                $generated_payslip->hourly_rate = $hourly_rate;
                $generated_payslip->total_present = number_format($total_hours_present,2);
                $generated_payslip->total_leave = 0;
                $generated_payslip->total_working_days = $total_day_present;
                $generated_payslip->tax = $withholding_tax;
                $generated_payslip->gross_salary = $gross_pay;
                $generated_payslip->created_by = Auth::user()->id;
                $generated_payslip->updated_by = Auth::user()->id;
                $generated_payslip->status = 1;
                $generated_payslip->per_day_salary = $hourly_rate * 8;
                $generated_payslip->taxable_salary = $gross_tax_income;
                $generated_payslip->net_salary = $net_pay;
                $generated_payslip->working_hour = number_format($total_hours_present,2);

                
                $generated_payslip->sss = $hasDeduction ? 0 : $sss;
                $generated_payslip->hdmf = $hasDeduction ? 0 : $hdmf;
                $generated_payslip->philhealth = $hasDeduction ? 0 : $philhealth;
                
                $generated_payslip->sss_loan = $sss_loan;
                $generated_payslip->hdmf_loan = $hdmf_loan;
                $generated_payslip->other_deduction = $other_deduction;
                $generate_payslip->other_credit = $other_credit;

                $generated_payslip->save();
            }
            
            if($generated_payslip){
                $message = "Successfully saved.";
            }else{
                $message = "Failed to save";
            }
        }
        return view('payroll/generated_payslips/add-generated_payslips')->with(['success'=>$message,'employee_attendances'=> $employee_attendances,'employees' => $employees ]);
    }

    public function deleteGeneratedPayslips($id)
    {
        $generate_payslip = GeneratedPayslips::where('id',$id);
        $message = null;
        $error = null;
        $generate_payslip->delete();
        $message = "Successfully delete.";
        
        return back()->with(["success" => $message, "error"=>$error]);
    }

    public function number_of_working_days_date($from_date, $to_date)
    {
        $holidays        = DB::select(DB::raw("SELECT * from holidays where date between '$from_date' AND '$to_date' "));
        $public_holidays = [];
        // foreach ($holidays as $holidays) {
        //     $start_date = $holidays->from_date;
        //     $end_date   = $holidays->to_date;
        //     while (strtotime($start_date) <= strtotime($end_date)) {
        //         $public_holidays[] = $start_date;
        //         $start_date        = date("Y-m-d", strtotime("+1 day", strtotime($start_date)));
        //     }
        // }

        $target      = strtotime($from_date);
        $workingDate = [];

        while ($target <= strtotime(date("Y-m-d", strtotime($to_date)))) {
            //get weekly  holiday name
            $timestamp = strtotime(date('Y-m-d', $target));
            $dayName   = date("l", $timestamp);
            
            if (!in_array(date('Y-m-d', $target), $public_holidays)) {
            array_push($workingDate, date('Y-m-d', $target));
            }
            // if (date('Y-m-d') <= date('Y-m-d', $target)) {
            //     break;
            // }
            $target += (60 * 60 * 24);
        }
        
        return $workingDate;
    }

    public function hourstodecimal($timeinhours) {

        $timeparts = explode(':', $timeinhours);
        return $timeparts[0] + ($timeparts[1]/60);
      
    }

    public function sendGeneratePayslips($id){
        require base_path("vendor/autoload.php");

        $generate_payslip = GeneratedPayslips::find($id)->toArray();

        $employee = Employee::find($generate_payslip['employee_id'])->toArray();
        $user = User::find($employee['user_id']);
        $data = [
            'employee' => $employee,
            'generated_payslip' => $generate_payslip
        ];
        $pdf = PDF::loadView('pdf/generate_payslip', $data);
        $mail = new PHPMailer(true);  

        // Email server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';             //  smtp host
        $mail->SMTPAuth = true;
        $mail->Username = 'hryoungliving2023dev@gmail.com';//'hryleo@makopa.online';   //  sender username
        $mail->Password = 'mgvdqpwagvmuywww';//'V99f!8MiU8jY';//'hryleo@admin';       // sender password
        $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
        $mail->Port = 465;                          // port - 587/465

        $mail->setFrom('hryleo@makopa.online', 'HR Young Living Essential Oil');
        $mail->addAddress($user->email_address);
        // $mail->addCC($request->emailCc);
        // $mail->addBCC($request->emailBcc);

        $mail->addReplyTo('hryleo@makopa.online', 'HR Young Living Essential Oil');

        $filename = $manual_payslip['name'].'_'.$manual_payslip['cut_off_date'].'.pdf'  ;
        $encoding = 'base64';
        $type = 'application/pdf';

        // $mail->addStringAttachment($pdf->output(),$filename,$encoding,$type);
        $mail->addStringAttachment($pdf->output(), $manual_payslip['name'].'_'.$manual_payslip['cut_off_date'].'.pdf');
        
        $mail->isHTML(true);                // Set email content format to HTML

        $mail->Subject = "Payslip ". $manual_payslip['name'].' - '.$manual_payslip['cut_off_date'];
        $mail->Body    = "test";

        // $mail->AltBody = plain text version of email body;
     
        if( !$mail->send() ) {
            return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
        }else {
            return back()->with("success", "Email has been sent.");
        }
    }

    public function pdfGeneratePayslips($id){
        require base_path("vendor/autoload.php");

        $generate_payslip = GeneratedPayslips::find($id)->toArray();

        $employee = Employee::find($generate_payslip['employee_id'])->toArray();
        $user = User::find($employee['user_id']);
        
        $data = [
            'employee' => $employee,
            'generated_payslip' => $generate_payslip
        ];
          
        $pdf = PDF::loadView('pdf/generate_payslip', $data);
    
        return $pdf->download($employee['first_name'].'_'.$employee['last_name'].'_'.$generate_payslip['month_of_salary'].'.pdf');
    }

    //leave management
    public function leave(){
        $leaves = LeaveApplication::all();
        if(Auth::user()->role_id == 1){
            $employee = Employee::where("user_id", Auth::user()->id)->first();
            $leaves = LeaveApplication::where('employee_no',$employee->employee_no)->get();
        }

        if(Auth::user()->role_id == 2){
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            $employee = Employee::where('supervisor_id',Auth::user()->id)->get();
            $employees = [];
            array_push($employees,$emp->unique_id);
            if($employee){
                foreach($employee as $key => $val){
                    array_push($employees,$val->employee_no);
                }
            }
            $leaves = LeaveApplication::whereIn('employee_no',$employees)->get();
        }
        return view('leave_management/leave_application/leave')->with(['leaves'=>$leaves,'message'=>'']);
    }


    public function addLeave(Request $request)
    {
        $message = "";
        if(Auth::user()->id != 1) {
            $employee = Employee::where("user_id", Auth::user()->id)->first();
        }else{
            $employee = new Employee();
        }
        $message = "";
        if($request->post()){
            $leave = new LeaveApplication();
            $message = "Attendance updated!";

            foreach($request->post() as $key => $value){

                if($key == "_token") continue;

                $leave->{$key} = $value;
            }
            $leave->save();

            if($leave){
                $message = "Successfully updated.";
                // $this->sendManualPayslip($manual_payslip->id);
            }else{
                $message = "Failed to save";
            }
        
        }
        return view('leave_management/leave_application/add-leave')->with(['success' => $message, 'employee' => $employee]);
    }

    public function editLeave(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $leave = LeaveApplication::find($id);
        if($leave) {
            if($request->post()){
                foreach($request->post() as $key => $value){

                    if($key == "_token") continue;
    
                    $leave->{$key} = $value;
                }
                $leave->save();
                if($leave){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('leave_management/leave_application/edit-leave')->with(['success'=>$message,'leave'=>$leave]);
        }

        return redirect()->route('leave_management/leave'); 
    }

    public function deleteLeave($id)
    {
        LeaveApplication::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }

    //overtime
    public function overtime(){
        $overtime = OvertimeApplication::all();
        if(Auth::user()->role_id == 1){
            $employee = Employee::where("user_id", Auth::user()->id)->first();
            $overtime = OvertimeApplication::where('employee_no',$employee->employee_no)->get();
        }

        if(Auth::user()->role_id == 2){
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            $employee = Employee::where('supervisor_id',Auth::user()->id)->get();
            $employees = [];
            array_push($employees,$emp->unique_id);
            if($employee){
                foreach($employee as $key => $val){
                    array_push($employees,$val->employee_no);
                }
            }
            $overtime = OvertimeApplication::whereIn('employee_no',$employees)->get();
        }
        return view('payroll/overtime/overtime')->with(['overtimes'=>$overtime,'message'=>'']);
    }


    public function addOvertime(Request $request)
    {
        $message = "";
        if(Auth::user()->id != 1) {
            $employee = Employee::where("user_id", Auth::user()->id)->first();
        }else{
            $employee = new Employee();
        }
        $message = "";
        if($request->post()){
            $overtime = new OvertimeApplication();
            $message = "Attendance updated!";

            foreach($request->post() as $key => $value){

                if($key == "_token") continue;

                $overtime->{$key} = $value;
            }
            $overtime->save();

            if($overtime){
                $message = "Successfully updated.";
            }else{
                $message = "Failed to save";
            }
        
        }
        return view('payroll/overtime/add-overtime')->with(['success' => $message, 'employee' => $employee]);
    }

    public function editOvertime(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $overtime = OvertimeApplication::find($id);
        if($overtime) {
            if($request->post()){
                foreach($request->post() as $key => $value){

                    if($key == "_token") continue;
    
                    $overtime->{$key} = $value;
                }
                $overtime->save();
                if($overtime){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }
            }

            return view('payroll/overtime/edit-overtime')->with(['success'=>$message,'overtime'=>$overtime]);
        }

        return redirect()->route('payroll/overtime'); 
    }

    public function deleteOvertime($id)
    {
        OvertimeApplication::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }

    //missing attendance
    public function missing_attendance(){
        $missing_attendance = MissingAttendance::all();
        if(Auth::user()->role_id == 1){
            $employee = Employee::where("user_id", Auth::user()->id)->first();
            $missing_attendance = MissingAttendance::where('employee_no',$employee->unique_id)->get();
        }

        if(Auth::user()->role_id == 2){
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            $employee = Employee::where('supervisor_id',Auth::user()->id)->get();
            $employees = [];
            array_push($employees,$emp->unique_id);
            if($employee){
                foreach($employee as $key => $val){
                    array_push($employees,$val->unique_id);
                }
            }
            $missing_attendance = MissingAttendance::whereIn('employee_no',$employees)->get();
        }
        return view('payroll/missing_attendance/missing_attendance')->with(['missing_attendances'=>$missing_attendance,'message'=>'']);
    }


    public function addMissingAttendance(Request $request)
    {
        $message = "";
        if(Auth::user()->id != 1) {
            $employee = Employee::where("user_id", Auth::user()->id)->first();
        }else{
            $employee = new Employee();
        }
        if($request->post()){
            $missing_attendance = new MissingAttendance();
            $message = "Attendance updated!";

            foreach($request->post() as $key => $value){

                if($key == "_token") continue;

                $missing_attendance->{$key} = $value;
            }
            $missing_attendance->save();

            if($missing_attendance){
                $message = "Successfully updated.";
            }else{
                $message = "Failed to save";
            }
        
        }
        return view('payroll/missing_attendance/add-missing_attendance')->with(['success' => $message, 'employee' => $employee]);
    }

    public function editMissingAttendance(Request $request, $id = 0)
    {
        $message = "";
        $id = $request->post('id') ?: $id;
        $missing_attendance = MissingAttendance::find($id);
        if($missing_attendance) {
            if($request->post()){
                foreach($request->post() as $key => $value){

                    if($key == "_token") continue;
    
                    $missing_attendance->{$key} = $value;
                }
                $missing_attendance->save();
                if($missing_attendance){
                    $message = "Successfully saved.";
                }else{
                    $message = "Failed to save";
                }

                if($request->post('status') == "Approved"){
                    $employee = Employee::where('unique_id', $request->post('employee_no'))->first();
                    $workshift = Workshift::where('id', $employee->work_shift_id)->first();
                    $employee_attendances = new EmployeeAttendance();
                    $employee_attendances->unique_id = $request->post('employee_no');
                    $employee_attendances->in_out_time = $request->post('date') . " " . $workshift->start_time;
                    $employee_attendances->Memoinfo = $request->post('Memoinfo');
                    $employee_attendances->save();

                    $employee_attendances = new EmployeeAttendance();
                    $employee_attendances->unique_id = $request->post('employee_no');
                    $employee_attendances->in_out_time =  $request->post('date') . " " . $workshift->end_time;
                    $employee_attendances->Memoinfo = $request->post('Memoinfo');
                    $employee_attendances->save();
                }
            }

            return view('payroll/missing_attendance/edit-missing_attendance')->with(['success'=>$message,'missing_attendance'=>$missing_attendance]);
        }

        return redirect()->route('payroll/missing_attendance'); 
    }

    public function deleteMissingAttendance($id)
    {
        MissingAttendance::where('id',$id)->delete();
        $message = "Successfully delete.";
        
        return back()->with("success", $message);
    }

    //payroll report
    public function report(Request $request) {
        $generated_payslips = GeneratedPayslips::paginate(20);
        if($request->post()){
            if(!empty($request->post('filter'))){
                $month_of_salary = [$request->post('from'), $request->post('to')];
                $generated_payslips = GeneratedPayslips::whereBetween('from_date', $month_of_salary)->paginate(20);
            }

            if(!empty($request->post('generate_payroll'))){
                $date = $request->post('from') . "-" . $request->post('to');
                return Excel::download(new PayrollReportExport($request->post('from'),$request->post('to')), 'payroll_report_'.$date.'.xlsx');
            }
        }

        return view('payroll/report/report')->with(['generated_payslips'=>$generated_payslips,'message'=>'']);
    }

    //employee deduction
    public function employeeDeductions($id){
        $employee_deduction = EmployeeDeduction::where('employee_id', $id)->orderBy('created_at','asc')->get();

        $employee = Employee::where('id', $id)->first();

        return view('payroll/employee_deduction/employee_deduction')->with(['employee_deduction'=> $employee_deduction, 'employee'=>$employee,'success'=>'']);
    }

    public function addEmployeeDeductions(Request $request, $id){
        
        $message = "";
        $deductions = Deduction::whereNotIn('tax',['TX','NTX'])->get();
        if($request->post()){
            $employee_deduction = new EmployeeDeduction();
            $employee_deduction->employee_id = $request->post('employee_id');
            $employee_deduction->deduction_id = $request->post('deduction_id');
            $employee_deduction->amount = $request->post('amount');
            $employee_deduction->date = $request->post('date');
            $employee_deduction->due_date = $request->post('due_date');
            $employee_deduction->terms = $request->post('terms');
            $employee_deduction->save();
            $message = "Saved!";
        }
        
        return view('payroll/employee_deduction/add-employee_deduction')->with(['deductions'=>$deductions,'success'=>$message, 'employee_id' => $id]);
    }

    public function editEmployeeDeductions(Request $request, $id){

        $message = "";
        $deductions = Deduction::whereNotIn('tax',['TX','NTX'])->get();
        $employee_deduction = EmployeeDeduction::find($id);
        if($employee_deduction) {

            if($request->post()){
                $employee_deduction->deduction_id = $request->post('deduction_id');
                $employee_deduction->amount = $request->post('amount');
                $employee_deduction->date = $request->post('date');
                $employee_deduction->due_date = $request->post('due_date');
                $employee_deduction->terms = $request->post('terms');
                $employee_deduction->save();
                $message = "Updated!";
            }
            
            return view('payroll/employee_deduction/edit-employee_deduction')->with(['deductions'=>$deductions, 'employee_deduction'=> $employee_deduction,'success'=>$message, 'employee_id' => $id]);
        }

        return redirect()->route('payroll/employee-deductions',[$id]); 
    }

    public function deleteEmployeeDeductions($id){
        $employee_deduction = EmployeeDeduction::find($id);
        $employee_deduction->delete();
        $message = "Deleted!";
        return back()->with("success", $message);
    }

    //employee credit
    public function employeeCredits($id){
        $employee_credit = EmployeeCredit::where('employee_id', $id)->orderBy('created_at','asc')->get();

        $employee = Employee::where('id', $id)->first();

        return view('payroll/employee_credit/employee_credit')->with(['employee_credit'=> $employee_credit, 'employee'=>$employee,'success'=>'']);
    }

    public function addEmployeeCredits(Request $request, $id){
        
        $message = "";
        $credits = Credit::all();
        if($request->post()){
            $employee_credit = new EmployeeCredit();
            $employee_credit->employee_id = $request->post('employee_id');
            $employee_credit->credit_id = $request->post('credit_id');
            $employee_credit->amount = $request->post('amount');
            $employee_credit->date = $request->post('date');
            $employee_credit->status = "Active";
            $employee_credit->save();
            $message = "Saved!";
        }
        
        return view('payroll/employee_credit/add-employee_credit')->with(['credits'=>$credits,'success'=>$message, 'employee_id' => $id]);
    }

    public function editEmployeeCredits(Request $request, $id){

        $message = "";
        $credits = Credit::all();
        $employee_credit = EmployeeCredit::find($id);
        if($employee_credit) {

            if($request->post()){
                $employee_credit->credit_id = $request->post('credit_id');
                $employee_credit->amount = $request->post('amount');
                $employee_credit->date = $request->post('date');
                $employee_credit->status = "Active";
                $employee_credit->save();
                $message = "Updated!";
            }
            
            return view('payroll/employee_credit/edit-employee_credit')->with(['credits'=>$credits, 'employee_credit'=> $employee_credit,'success'=>$message, 'employee_id' => $id]);
        }

        return redirect()->route('payroll/employee-credits',[$id]); 
    }

    public function deleteEmployeeCredits($id){
        $employee_credit = EmployeeCredit::find($id);
        $employee_credit->delete();
        $message = "Deleted!";
        return back()->with("success", $message);
    }
}

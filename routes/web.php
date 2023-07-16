<?php
date_default_timezone_set('Asia/Taipei');
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/attendance', [App\Http\Controllers\WebAttendanceController::class, 'index'])->name('attendance');

Route::post('/attendance', [App\Http\Controllers\WebAttendanceController::class, 'index'])->name('attendance');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Administration
Route::get('adm/change_password', [App\Http\Controllers\AdministrationController::class, 'index'])->name('adm/change_password');
    //role
    Route::get('adm/role', [App\Http\Controllers\AdministrationController::class, 'role'])->name('adm/role');
    Route::get('adm/add-role', [App\Http\Controllers\AdministrationController::class, 'addRole'])->name('adm/add-role');
    Route::post('adm/add-role', [App\Http\Controllers\AdministrationController::class, 'addRole'])->name('adm/add-role');
    Route::get('adm/edit-role/{id}', [App\Http\Controllers\AdministrationController::class, 'editRole'])->name('adm/edit-role');
    Route::post('adm/edit-role', [App\Http\Controllers\AdministrationController::class, 'editRole'])->name('adm/edit-role');
    Route::get('adm/delete-role/{id}', [App\Http\Controllers\AdministrationController::class, 'deleteRole'])->name('adm/delete-role');
Route::get('adm/permissions', [App\Http\Controllers\AdministrationController::class, 'permissions'])->name('adm/permissions');

// Employee management
    // manage employee
    Route::get('em/manage_employee', [App\Http\Controllers\EmployeeManagementController::class, 'index'])->name('em/manage_employee');
    Route::get('em/add-employee', [App\Http\Controllers\EmployeeManagementController::class, 'addEmployee'])->name('em/add-employee');
    Route::post('em/add-employee', [App\Http\Controllers\EmployeeManagementController::class, 'addEmployee'])->name('em/add-employee');
    Route::get('em/edit-employee/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'editEmployee'])->name('em/edit-employee');
    Route::post('em/edit-employee', [App\Http\Controllers\EmployeeManagementController::class, 'editEmployee'])->name('em/edit-employee');
    Route::get('em/delete-employee/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'deleteEmployee'])->name('em/delete-employee');


    //department
    Route::get('em/department', [App\Http\Controllers\EmployeeManagementController::class, 'department'])->name('em/department');
    Route::get('em/add-department', [App\Http\Controllers\EmployeeManagementController::class, 'addDepartment'])->name('em/add-department');
    Route::post('em/add-department', [App\Http\Controllers\EmployeeManagementController::class, 'addDepartment'])->name('em/add-department');
    Route::get('em/edit-department/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'editDepartment'])->name('em/edit-department');
    Route::post('em/edit-department', [App\Http\Controllers\EmployeeManagementController::class, 'editDepartment'])->name('em/edit-department');
    Route::get('em/delete-department/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'deleteDepartment'])->name('em/delete-department');

    //designation
    Route::get('em/designation', [App\Http\Controllers\EmployeeManagementController::class, 'designation'])->name('em/designation');
    Route::get('em/add-designation', [App\Http\Controllers\EmployeeManagementController::class, 'addDesignation'])->name('em/add-designation');
    Route::post('em/add-designation', [App\Http\Controllers\EmployeeManagementController::class, 'addDesignation'])->name('em/add-designation');
    Route::get('em/edit-designation/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'editDesignation'])->name('em/edit-designation');
    Route::post('em/edit-designation', [App\Http\Controllers\EmployeeManagementController::class, 'editDesignation'])->name('em/edit-designation');
    Route::get('em/delete-designation/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'deleteDesignation'])->name('em/delete-designation');

    //branch
    Route::get('em/branch', [App\Http\Controllers\EmployeeManagementController::class, 'branch'])->name('em/branch');
    Route::get('em/add-branch', [App\Http\Controllers\EmployeeManagementController::class, 'addBranch'])->name('em/add-branch');
    Route::post('em/add-branch', [App\Http\Controllers\EmployeeManagementController::class, 'addBranch'])->name('em/add-branch');
    Route::get('em/edit-branch/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'editBranch'])->name('em/edit-branch');
    Route::post('em/edit-branch', [App\Http\Controllers\EmployeeManagementController::class, 'editBranch'])->name('em/edit-branch');
    Route::get('em/delete-branch/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'deleteBranch'])->name('em/delete-branch');

Route::get('em/warning', [App\Http\Controllers\EmployeeManagementController::class, 'warning'])->name('em/warning');
Route::get('em/termination', [App\Http\Controllers\EmployeeManagementController::class, 'termination'])->name('em/termination');
Route::get('em/promotion', [App\Http\Controllers\EmployeeManagementController::class, 'promotion'])->name('em/promotion');

// Attendance

    //dashboard
    Route::get('atd/dashboard', [App\Http\Controllers\AttendanceController::class, 'index'])->name('atd/dashboard');
    Route::post('atd/dashboard/import',[App\Http\Controllers\AttendanceController::class,'import'])->name('atd/dashboard/import');
    // workshift
    Route::get('atd/workshifts', [App\Http\Controllers\AttendanceController::class, 'workshifts'])->name('atd/workshifts');
    Route::get('atd/add-edit-workshifts', [App\Http\Controllers\AttendanceController::class, 'addEditWorkshift'])->name('atd/add-edit-workshifts');
    Route::post('atd/add-edit-workshifts', [App\Http\Controllers\AttendanceController::class, 'addEditWorkshift'])->name('atd/add-edit-workshifts');
    Route::get('atd/delete-workshifts/{id}', [App\Http\Controllers\AttendanceController::class, 'deleteWorkshift'])->name('atd/delete-workshifts');

// Payslip

    //Manual Payslip
    Route::get('payroll/manual_payslip', [App\Http\Controllers\PayrollController::class, 'index'])->name('payroll/manual_payslip');
    Route::get('payroll/add-manual_payslip', [App\Http\Controllers\PayrollController::class, 'addManualPayslip'])->name('payroll/add-manual_payslip');
    Route::post('payroll/add-manual_payslip', [App\Http\Controllers\PayrollController::class, 'addManualPayslip'])->name('payroll/add-manual_payslip');
    Route::get('payroll/edit-manual_payslip/{id}', [App\Http\Controllers\PayrollController::class, 'editManualPayslip'])->name('payroll/edit-manual_payslip');
    Route::post('payroll/edit-manual_payslip', [App\Http\Controllers\PayrollController::class, 'editManualPayslip'])->name('payroll/edit-manual_payslip');
    Route::get('payroll/delete-manual_payslip/{id}', [App\Http\Controllers\PayrollController::class, 'deleteManualPayslip'])->name('payroll/delete-manual_payslip');
    Route::get('payroll/generate-manual_payslip/{id}', [App\Http\Controllers\PayrollController::class, 'generateManualPayslip'])->name('payroll/generate-manual_payslip');
    Route::get('payroll/send-manual_payslip/{id}', [App\Http\Controllers\PayrollController::class, 'sendManualPayslip'])->name('payroll/send-manual_payslip');

    //Deduction
    Route::get('payroll/deduction', [App\Http\Controllers\PayrollController::class, 'deduction'])->name('payroll/deduction');
    Route::get('payroll/add-deduction', [App\Http\Controllers\PayrollController::class, 'addDeduction'])->name('payroll/add-deduction');
    Route::post('payroll/add-deduction', [App\Http\Controllers\PayrollController::class, 'addDeduction'])->name('payroll/add-deduction');
    Route::get('payroll/edit-deduction/{id}', [App\Http\Controllers\PayrollController::class, 'editDeduction'])->name('payroll/edit-deduction');
    Route::post('payroll/edit-deduction', [App\Http\Controllers\PayrollController::class, 'editDeduction'])->name('payroll/edit-deduction');
    Route::get('payroll/delete-deduction/{id}', [App\Http\Controllers\PayrollController::class, 'deleteDeduction'])->name('payroll/delete-deduction');
    Route::get('payroll/range-table-deduction/{id}', [App\Http\Controllers\PayrollController::class, 'rangeTableDeduction'])->name('payroll/range-table-deduction');
    Route::post('payroll/range-table-deduction', [App\Http\Controllers\PayrollController::class, 'rangeTableDeduction'])->name('payroll/range-table-deduction');
    

    //Deduction
    Route::get('payroll/credit', [App\Http\Controllers\PayrollController::class, 'credit'])->name('payroll/credit');
    Route::get('payroll/add-credit', [App\Http\Controllers\PayrollController::class, 'addCredit'])->name('payroll/add-credit');
    Route::post('payroll/add-credit', [App\Http\Controllers\PayrollController::class, 'addCredit'])->name('payroll/add-credit');
    Route::get('payroll/edit-credit/{id}', [App\Http\Controllers\PayrollController::class, 'editCredit'])->name('payroll/edit-credit');
    Route::post('payroll/edit-credit', [App\Http\Controllers\PayrollController::class, 'editCredit'])->name('payroll/edit-credit');
    Route::get('payroll/delete-credit/{id}', [App\Http\Controllers\PayrollController::class, 'deleteCredit'])->name('payroll/delete-credit');

    //Holidays
    Route::get('payroll/holidays', [App\Http\Controllers\PayrollController::class, 'holidays'])->name('payroll/holidays');
    Route::get('payroll/add-holidays', [App\Http\Controllers\PayrollController::class, 'addHolidays'])->name('payroll/add-holidays');
    Route::post('payroll/add-holidays', [App\Http\Controllers\PayrollController::class, 'addHolidays'])->name('payroll/add-holidays');
    Route::get('payroll/edit-holidays/{id}', [App\Http\Controllers\PayrollController::class, 'editHolidays'])->name('payroll/edit-holidays');
    Route::post('payroll/edit-holidays', [App\Http\Controllers\PayrollController::class, 'editHolidays'])->name('payroll/edit-holidays');
    Route::get('payroll/delete-holidays/{id}', [App\Http\Controllers\PayrollController::class, 'deleteHolidays'])->name('payroll/delete-holidays');

    //Generated Payslips
    Route::get('payroll/generated_payslips', [App\Http\Controllers\PayrollController::class, 'generatedPayslips'])->name('payroll/generated_payslips');
    Route::get('payroll/add-generated_payslips', [App\Http\Controllers\PayrollController::class, 'addGeneratedPayslips'])->name('payroll/add-generated_payslips');
    Route::post('payroll/add-generated_payslips', [App\Http\Controllers\PayrollController::class, 'addGeneratedPayslips'])->name('payroll/add-generated_payslips');
    Route::get('payroll/delete-generated_payslip/{id}', [App\Http\Controllers\PayrollController::class, 'deleteGeneratedPayslips'])->name('payroll/delete-generated_payslip');
    Route::get('payroll/generate-payslip/{id}', [App\Http\Controllers\PayrollController::class, 'pdfGeneratePayslips'])->name('payroll/generate-payslip');
    Route::get('payroll/send-generate-payslip/{id}', [App\Http\Controllers\PayrollController::class, 'autoGeneratePayslips'])->name('payroll/send-generate-payslip');

    // leave management
    Route::get('leave_management/leave', [App\Http\Controllers\PayrollController::class, 'leave'])->name('leave_management/leave');
    Route::get('leave_management/add-leave', [App\Http\Controllers\PayrollController::class, 'addLeave'])->name('leave_management/add-leave');
    Route::post('leave_management/add-leave', [App\Http\Controllers\PayrollController::class, 'addLeave'])->name('leave_management/add-leave');
    Route::get('leave_management/edit-leave/{id}', [App\Http\Controllers\PayrollController::class, 'editLeave'])->name('leave_management/edit-leave');
    Route::post('leave_management/edit-leave', [App\Http\Controllers\PayrollController::class, 'editLeave'])->name('leave_management/edit-leave');
    Route::get('leave_management/delete-leave/{id}', [App\Http\Controllers\PayrollController::class, 'deleteLeave'])->name('leave_management/delete-leave');

    // overtime
    Route::get('payroll/overtime', [App\Http\Controllers\PayrollController::class, 'overtime'])->name('payroll/overtime');
    Route::get('payroll/add-overtime', [App\Http\Controllers\PayrollController::class, 'addOvertime'])->name('payroll/add-overtime');
    Route::post('payroll/add-overtime', [App\Http\Controllers\PayrollController::class, 'addOvertime'])->name('payroll/add-overtime');
    Route::get('payroll/edit-overtime/{id}', [App\Http\Controllers\PayrollController::class, 'editOvertime'])->name('payroll/edit-overtime');
    Route::post('payroll/edit-overtime', [App\Http\Controllers\PayrollController::class, 'editOvertime'])->name('payroll/edit-overtime');
    Route::get('payroll/delete-overtime/{id}', [App\Http\Controllers\PayrollController::class, 'deleteOvertime'])->name('payroll/delete-overtime');
    
    // missing attendance
    Route::get('payroll/missing_attendance', [App\Http\Controllers\PayrollController::class, 'missing_attendance'])->name('payroll/missing_attendance');
    Route::get('payroll/add-missing_attendance', [App\Http\Controllers\PayrollController::class, 'addMissingAttendance'])->name('payroll/add-missing_attendance');
    Route::post('payroll/add-missing_attendance', [App\Http\Controllers\PayrollController::class, 'addMissingAttendance'])->name('payroll/add-missing_attendance');
    Route::get('payroll/edit-missing_attendance/{id}', [App\Http\Controllers\PayrollController::class, 'editMissingAttendance'])->name('payroll/edit-missing_attendance');
    Route::post('payroll/edit-missing_attendance', [App\Http\Controllers\PayrollController::class, 'editMissingAttendance'])->name('payroll/edit-missing_attendance');
    Route::get('payroll/delete-missing_attendance/{id}', [App\Http\Controllers\PayrollController::class, 'deleteMissingAttendance'])->name('payroll/delete-missing_attendance');
    
    //payroll report
    Route::get('payroll/report', [App\Http\Controllers\PayrollController::class, 'report'])->name('payroll/report');
    Route::post('payroll/report', [App\Http\Controllers\PayrollController::class, 'report'])->name('payroll/report');
    Route::post('payroll/report/export', [App\Http\Controllers\PayrollController::class, 'exportPayrollReport'])->name('payroll/report/export');

    //employee deduction
    Route::get('payroll/employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'employeeDeductions'])->name('payroll/employee-deductions');
    Route::get('payroll/add-employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'addEmployeeDeductions']);
    Route::post('payroll/add-employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'addEmployeeDeductions']);
    Route::get('payroll/edit-employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'editEmployeeDeductions']);
    Route::post('payroll/edit-employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'editEmployeeDeductions']);
    Route::get('payroll/delete-employee-deductions/{id}', [App\Http\Controllers\PayrollController::class, 'deleteEmployeeDeductions']);
    
    
    //employee credits
    Route::get('payroll/employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'employeeCredits'])->name('payroll/employee-deductions');
    Route::get('payroll/add-employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'addEmployeeCredits']);
    Route::post('payroll/add-employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'addEmployeeCredits']);
    Route::get('payroll/edit-employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'editEmployeeCredits']);
    Route::post('payroll/edit-employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'editEmployeeCredits']);
    Route::get('payroll/delete-employee-credits/{id}', [App\Http\Controllers\PayrollController::class, 'deleteEmployeeCredits']);
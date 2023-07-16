<?php use App\Models\Role; ?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background:#fff" href="/">
                <img style="width:100%" src="https://images.ctfassets.net/qx1dg9syx02d/5oUBHKJeQvkrp1ZFH4DnXu/d17b5dd51ef5150c2f6b78fdf6cbb310/yl-logo-color.svg" />
                    
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Management
            </div>
            <?php 
            $roles = Role::find(Auth::user()->role_id);
            $permissions = explode(',',$roles->permissions);
            ?>
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Administration -->
            @if(in_array('administration',$permissions))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administration"
                    aria-expanded="true" aria-controls="administration">
                    <i class="fas fa-fw fa-key"></i>
                    <span>Administration</span>
                </a>
                <div id="administration" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Role:</h6>
                        <a class="collapse-item" href="{{ route('adm/role')}}">Role</a>
                    </div>
                    <!-- <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('adm/change_password')}}">Change password</a>
                    </div> -->
                </div>
            </li>
            @endif

            <!-- Employee Management -->
            @if(in_array('department',$permissions) || in_array('designation',$permissions) || in_array('branch',$permissions) || in_array('manage_employee',$permissions))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employee_management"
                    aria-expanded="true" aria-controls="employee_management">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Employee Management</span>
                </a>
                <div id="employee_management" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Employee setup:</h6>
                        @if(in_array('department',$permissions))
                        <a class="collapse-item" href="{{ route('em/department')}}">Department</a>
                        @endif

                        @if(in_array('designation',$permissions))
                        <a class="collapse-item" href="{{ route('em/designation')}}">Designation</a>
                        @endif
                        
                        @if(in_array('branch',$permissions))
                        <a class="collapse-item" href="{{ route('em/branch')}}">Branch</a>
                        @endif

                        @if(in_array('manage_employee',$permissions))
                        <a class="collapse-item" href="{{ route('em/manage_employee')}}">Manage Employee</a>
                        @endif
                        <!-- <a class="collapse-item" href="{{ route('em/warning')}}">Warning</a>
                        <a class="collapse-item" href="{{ route('em/termination')}}">Termination</a>
                        <a class="collapse-item" href="{{ route('em/promotion')}}">Promotion</a> -->
                    </div>
                </div>
            </li>
            @endif

            <!-- Leave Management -->
            @if(in_array('holidays',$permissions) || in_array('apply_for_leave',$permissions) || in_array('leave_requested_application',$permissions))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#leave_management"
                    aria-expanded="true" aria-controls="leave_management">
                    <i class="fas fa-fw fa-arrow-right"></i>
                    <span>Leave Management</span>
                </a>
                <div id="leave_management" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    @if(in_array('holidays',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <h6 class="collapse-header">Setup:</h6>
                        <a class="collapse-item" href="{{ route('payroll/holidays')}}">Holidays</a>
                        <!-- <a class="collapse-item" href="#">Manage Holiday</a>
                        <a class="collapse-item" href="#">Public Holiday</a>
                        <a class="collapse-item" href="#">Weekly Holiday</a>
                        <a class="collapse-item" href="#">Leave Type</a>
                        <a class="collapse-item" href="#">Earn Leave Configuration</a> -->
                    </div>
                    @endif
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Leave Application:</h6>
                        @if(in_array('apply_for_leave',$permissions))
                        <a class="collapse-item" href="{{ route('leave_management/add-leave')}}">Apply for Leave</a>
                        @endif

                        @if(in_array('leave_requested_application',$permissions))
                        <a class="collapse-item" href="{{ route('leave_management/leave')}}">Requested Application</a>
                        @endif
                    </div>
                </div>
            </li>
            @endif

            <!-- Attendance -->
            @if(in_array('manage_workshift',$permissions) || in_array('dashboard_attendance',$permissions) || in_array('reports',$permissions))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#attendance"
                    aria-expanded="true" aria-controls="attendance">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Attendance</span>
                </a>
                <div id="attendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Setup:</h6>
                        @if(in_array('manage_workshift',$permissions))
                        <a class="collapse-item" href="{{ route('atd/workshifts')}}">Manage work shift</a>
                        @endif

                        @if(in_array('dashboard_attendance',$permissions))
                        <a class="collapse-item" href="{{ route('atd/dashboard')}}">Dashboard attendance</a>
                        @endif
                    </div>
                    @if(in_array('reports',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report:</h6>
                        <a class="collapse-item" href="#">Daily Attendance</a>
                        <a class="collapse-item" href="#">Monthly Attendance</a>
                        <a class="collapse-item" href="#">My Attendance Report</a>
                        <a class="collapse-item" href="#">Summary Report</a>
                    </div>
                    @endif
                </div>
            </li>
            @endif

            <!-- Payroll -->
            @if(in_array('credit',$permissions) || in_array('deductions',$permissions) || in_array('manual_payslip',$permissions) || in_array('generate_salary_sheet',$permissions) || in_array('reports',$permissions) || in_array('apply_for_overtime',$permissions) || in_array('overtime_requested_application',$permissions) || in_array('apply_for_missing_attendance',$permissions) || in_array('missing_attendance_requested_application',$permissions))
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payroll"
                    aria-expanded="true" aria-controls="payroll">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Payroll</span>
                </a>
                <div id="payroll" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    @if(in_array('credit',$permissions) || in_array('deductions',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Setup:</h6>
                        @if(in_array('credit',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/credit')}}">Credit</a>
                        @endif

                        @if(in_array('deductions',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/deduction')}}">Deductions</a>
                        @endif
                    </div>
                    @endif
                    
                    @if(in_array('manual_payslip',$permissions) || in_array('generate_salary_sheet',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Setup:</h6>
                        @if(in_array('manual_payslip',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/manual_payslip')}}">Manual Payslip</a>
                        @endif
                        <!-- <a class="collapse-item" href="#">Monthly Pay Grade</a>
                        <a class="collapse-item" href="#">Hourly Pay Grade</a> -->
                        @if(in_array('generate_salary_sheet',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/generated_payslips')}}">Generate Salary Sheet</a>
                        @endif
                    </div>
                    @endif

                    @if(in_array('reports',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report:</h6>
                        <a class="collapse-item" href="{{ route('payroll/report') }}">Report</a>
                        <a class="collapse-item" href="#">Payment History</a>
                        <a class="collapse-item" href="#">My Payroll</a>
                    </div>
                    @endif
                    
                    @if(in_array('apply_for_overtime',$permissions) || in_array('overtime_requested_application',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Overtime:</h6>
                        @if(in_array('apply_for_overtime',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/add-overtime')}}">Apply for Overtime</a>
                        @endif

                        @if(in_array('overtime_requested_application',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/overtime')}}">Requested Application</a>
                        @endif
                    </div>
                    @endif

                    @if(in_array('apply_for_missing_attendance',$permissions) || in_array('missing_attendance_requested_application',$permissions))
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Missing Attendance:</h6>
                        @if(in_array('apply_for_missing_attendance',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/add-missing_attendance')}}">Apply for Missing Attendance</a>
                        @endif

                        @if(in_array('missing_attendance_requested_application',$permissions))
                        <a class="collapse-item" href="{{ route('payroll/missing_attendance')}}">Requested Application</a>
                        @endif
                    </div>
                    @endif
                    <!-- <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Work Hour:</h6>
                        <a class="collapse-item" href="#">Approve Work Hour</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Bonus:</h6>
                        <a class="collapse-item" href="#">Bonus Setting</a>
                        <a class="collapse-item" href="#">Generate Bonus</a>
                    </div> -->
                </div>
            </li>
            @endif
            <!-- Performance -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#performance"
                    aria-expanded="true" aria-controls="performance">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Performance</span>
                </a>
                <div id="performance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Performance Category</a>
                        <a class="collapse-item" href="#">Performance Criteria</a>
                        <a class="collapse-item" href="#">Employee Performance</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report:</h6>
                        <a class="collapse-item" href="#">Summary Report</a>
                    </div>
                </div>
            </li> -->

            <!-- Recruitment -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#recruitment"
                    aria-expanded="true" aria-controls="recruitment">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Recruitment</span>
                </a>
                <div id="recruitment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Job Post</a>
                        <a class="collapse-item" href="#">Job Candidate</a>
                    </div>
                </div>
            </li> -->

            <!-- Training -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#training"
                    aria-expanded="true" aria-controls="training">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Training</span>
                </a>
                <div id="training" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Training Type</a>
                        <a class="collapse-item" href="#">Training List</a>
                        <a class="collapse-item" href="#">Training Report</a>
                    </div>
                </div>
            </li> -->

            <!-- Award -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#award"
                    aria-expanded="true" aria-controls="award">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span>Award</span>
                </a>
                <div id="award" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Award</a>
                    </div>
                </div>
            </li> -->

            <!-- Notice Board -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notice_board"
                    aria-expanded="true" aria-controls="notice_board">
                    <i class="fas fa-fw fa-exclamation-circle"></i>
                    <span>Notice Board</span>
                </a>
                <div id="notice_board" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Notice</a>
                    </div>
                </div>
            </li> -->

            <!-- Settings -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings"
                    aria-expanded="true" aria-controls="settings">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
                <div id="settings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Settings</a>
                    </div>
                </div>
            </li> -->

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{asset('admin/img/undraw_rocket.svg')}}" alt="...">
                <p class="text-center mb-2"><strong>Hr System</strong> Friendly reminders please don't forget to time and time-out</p>
            </div> -->

        </ul>
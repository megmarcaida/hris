<?php

namespace App\Exports;

use App\Models\GeneratedPayslips;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;

class PayrollReportExport implements FromArray, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles, WithPreCalculateFormulas
{
    
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function array(): array
    {
        return GeneratedPayslips::whereBetween('from_date', [$this->from, $this->to])->with('employee')->get()->toArray();
    }

    public function headings(): array
    {
        $month = date("F", strtotime($this->from));
        $from_day = date("d", strtotime($this->from));
        $to_day = date("d", strtotime($this->to));
        $year = date("Y", strtotime($this->from));

        return [
            [
                "YOUNG LIVING PHILIPPINES LLC"
            ],
            [
                "Payroll register"
            ],
            [
                $month . " " . $from_day . "-" . $to_day . ", " . $year
            ],
            [
                ""
            ],
            [
                'Cost Center',
                'Employee Number',
                'Employee name',
                'Basic Pay',
                'Overtime Pay',
                'Allowance',
                '13th Month Pay - TX',
                'Salary Adjustment',
                'Leave Conversion',
                'Late and Absences',
                'Gross Taxable Income',
                '13th Month Pay - NTX',
                'Mobile Subsidies',
                'REIMBURSEMENT',
                'Fleet Card',
                'Sickness Benefits',
                'Gross non-taxable income',
                'Gross pay',
                'Withholding tax',
                'SSS',
                'Philhealth',
                'Pag-IBIG',
                'SSS Loan',
                'HDMF Loan',
                'SSS Calamity Loan',
                'Pag-IBIG MP2',
                'Total deduction',
                'Net pay',
                'SSS Employer',
                'ECC',
                'Philhealth Employer',
                'Pag-IBIG Employer'
            ],
            [
                ""
            ]
        ];
    }

    public function map($generated_payslip): array
    {

        $thirteen_mo_pay_ntx = 0;
        $mobile_subsidies = 0;
        $reimbursement = 0;
        $fleet_card = 0;
        $sickness_benefits = 0;
        $gross_non_tax_income = $thirteen_mo_pay_ntx + $mobile_subsidies + $reimbursement + $fleet_card + $sickness_benefits;

        $total_deductions = $generated_payslip["tax"] + $generated_payslip["sss"] + $generated_payslip["philhealth"] + $generated_payslip["hdmf"];
        return [
            [
            "",
            $generated_payslip["employee"]["employee_no"],
            $generated_payslip["employee"]["first_name"] . " " . $generated_payslip["employee"]["last_name"],
            $generated_payslip["basic_salary"],
            $generated_payslip["total_overtime_amount"],
            "0.00", // allowance
            "0.00", // 13th month pay - tx
            "0.00", // salary adjustment
            "0.00", // leave conversion
            $generated_payslip["total_absence_amount"],
            $generated_payslip["basic_salary"] + $generated_payslip["total_overtime_amount"] + (-$generated_payslip["total_absence_amount"]), //gross tax income 
            "0.00", // 13th Month Pay - NTX
            "0.00", // Mobile Subsidies
            "0.00", // REIMBURSEMENT,
            "0.00", // Flee Card
            "0.00", // Sickness Benefits
            $gross_non_tax_income ? $gross_non_tax_income : "0.00",
            $generated_payslip["gross_salary"],
            $generated_payslip["tax"],
            $generated_payslip["sss"],
            $generated_payslip["philhealth"],
            $generated_payslip["hdmf"],
            "0.00", // SSS Loan
            "0.00", // HDMF Loan
            "0.00", // SSS Calamity Loan
            "0.00", // Pag-IBIG MP2
            $total_deductions,
            $generated_payslip["net_salary"],
            "0.00", // SSS Employer
            "0.00", // ECC
            "0.00", // Philhealth Employer
            "0.00" // Pag-IBIG Employer
            ]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'O' => NumberFormat::FORMAT_NUMBER_00,
            'P' => NumberFormat::FORMAT_NUMBER_00,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
            'S' => NumberFormat::FORMAT_NUMBER_00,
            'T' => NumberFormat::FORMAT_NUMBER_00,
            'U' => NumberFormat::FORMAT_NUMBER_00,
            'V' => NumberFormat::FORMAT_NUMBER_00,
            'W' => NumberFormat::FORMAT_NUMBER_00,
            'X' => NumberFormat::FORMAT_NUMBER_00,
            'Y' => NumberFormat::FORMAT_NUMBER_00,
            'Z' => NumberFormat::FORMAT_NUMBER_00,
            'AA' => NumberFormat::FORMAT_NUMBER_00,
            'AB' => NumberFormat::FORMAT_NUMBER_00,
            'AC' => NumberFormat::FORMAT_NUMBER_00,
            'AD' => NumberFormat::FORMAT_NUMBER_00,
            'AE' => NumberFormat::FORMAT_NUMBER_00
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true, "italic"=>true]],
            3    => ['font' => ['bold' => true]],
            5    => ['font' => ['bold' => true]],
            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}

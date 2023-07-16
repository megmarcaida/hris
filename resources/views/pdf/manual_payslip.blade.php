<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>
    <style type="text/css">
        @font-face {font-family: "GT Walsheim Regular"; src: url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.eot"); src: url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.woff") format("woff"), url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/768446cc3d04d6dd3289ae1715bdb682.svg#GT Walsheim Regular") format("svg"); }
        @page {
            margin: 10px;
        }
        body {
            margin: 10px;
        }
        * {
            font-family: "GT Walsheim Regular";
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
            font-family: "GT Walsheim Regular";
        }
        table thead tr td{
            font-family: "GT Walsheim Regular";
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #fff;
        }
        .information .logo {
            margin:     ;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="center">
                <img src="https://i.ibb.co/vsJbxyF/yl-logo.png" alt="Logo" class="logo"/>
                
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">
    
    <table width="100%">
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td>Cut-off date: {{ $cut_off_date }}</td>
            <td>Payout date: {{ $pay_out_date }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Name:</td>
            <td>{{ $name }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>ID Number:</td>
            <td>{{ $id_number }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Company Name: </td>
            <td>{{ $company_name }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Basic Salary:</td>
            <td>P {{$basic_salary}}</td>
            <td>&nbsp;</td>
            <td>Tax:</td>
            <td>P {{$tax}}</td>
            <td>&nbsp;</td>
            <td>Total Gross:</td>
            <td>P {{$total_gross}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Overtime:+</td>
            <td>P {{$overtime}}</td>
            <td>&nbsp;</td>
            <td>SSS:</td>
            <td>P {{$sss}}</td>
            <td>&nbsp;</td>
            <td>Total Deduction:</td>
            <td>P {{$total_deduction}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Late:-</td>
            <td>P {{$late}}</td>
            <td>&nbsp;</td>
            <td>HDMF:</td>
            <td>P {{$hdmf}}</td>
            <td>&nbsp;</td>
            <td>Allowances:</td>
            <td>P {{$allowances}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Absent:-</td>
            <td>P {{$absent}}</td>
            <td>&nbsp;</td>
            <td>PHIC:</td>
            <td>P {{$phic}}</td>
            <td>&nbsp;</td>
            <td>Other credit:</td>
            <td>P {{$other_credit}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gross total:</td>
            <td>P {{$total_gross}}</td>
            <td>&nbsp;</td>
            <td>Loan:</td>
            <td>P {{$loan}}</td>
            <td>&nbsp;</td>
            <td>Net pay:</td>
            <td>P {{$net_pay}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td>Other Deduction:</td>
            <td>P {{$other_deduction}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td>Total Deduction:</td>
            <td>P {{$total_deduction}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td>HDMF Loan Balance:</td>
            <td>P {{$hdmf_loan_balance}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td>SSS Loan Balance:</td>
            <td>P {{$sss_loan_balance}}</td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Young Living Essential Oil
            </td>
        </tr>

    </table>
</div>
</body>
</html>
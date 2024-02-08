<!DOCTYPE html>
<html>

<head>
    <title>{{ Str::slug($payroll->month->name . ' ' . $payroll->employee->code) }}</title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-40 {
        width: 40%;
    }

    .w-20 {
        width: 20%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .w-65 {
        width: 65%;
    }

    .w-70 {
        width: 70%;
    }

    .w-35 {
        width: 35%;
    }

    .w-30 {
        width: 30%;
    }

    .logo img {
        width: 75px;
        height: 75px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }


    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="m-0 p-0 w-15" align="left">
                <img src="{{ public_path('images/logo-ibr.png') }}" alt="" style="width: 60px;">
            </td>
            <td class="m-0 p-0 w-70" align="center">
                <h1>{{ $payroll->month->company }}</h1>
            </td>
            <td class="m-0 p-0 w-15" align="right">
                <img src="{{ public_path('images/logo-birla.png') }}" alt="" style="width: 120px;">
            </td>
        </tr>
    </table>
    <div style="clear: both;" class="m-0 p-0"></div>
    <div class="w-100"
        style="border-top:none;border-bottom:2px dotted rgb(0, 0, 0);padding-top: 4px; padding-bottom: 4px;margin-bottom:5px">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->month->company }}
                </td>
                <td class="m-0 p-0" align="right">
                    <small>Pay Slip for the month of : {{ $payroll->month->name }}</small>
                </td>
            </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
    <div class="w-40 float-left ">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
            <tr>
                <td class="m-0 p-0" align="left" width="30%">
                    Emp. Cd / Name
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->code }}
                    /
                    {{ $payroll->employee->full_name }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    Designation
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->designation->name }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    Grade
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->grade->name }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    Basic <small style="font-size: 11px">(Rup)</small>
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left" style="font-weight: bold">
                    {{ number_format($payroll->employee->basic_salary, 0, '.', '.') }}
                </td>
            </tr>
        </table>
    </div>
    <div class="w-40 float-left ">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
            <tr>
                <td class="m-0 p-0" align="left" width="35%">
                    Dept.
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->department->name }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    Jamsostek
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->jamsostek }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    NPWP No
                </td>
                <td style="padding-right: 0.5rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    {{ $payroll->employee->npwp }}
                </td>
            </tr>
        </table>
    </div>
    <div class="w-20 float-left ">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
            <tr>
                <td class="m-0 p-0" align="center">
                    Var.Days
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="center">
                    Paid Days : {{ $payroll->paid_days }}
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="center">
                    Leave Dtl : {{ $payroll->leave_detail }}
                </td>
            </tr>

        </table>
    </div>
    <div style="clear: both;"></div>
    {{-- detail amount and deductions --}}
    <div class="add-detail mt-10" style="border-top:2px dotted rgb(0, 0, 0);border-bottom:none; padding-top: 4px;">
        <div class="w-40 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px dotted rgb(0, 0, 0);border-top:none;">
                    <td class="text-bold m-0 p-0" align="left" style="padding-bottom:0.5rem">
                        Earnings
                    </td>
                    <td class="text-bold m-0 p-0" align="left" style="padding-bottom:0.5rem">
                        Amount <small>({{ $payroll->employee->currency_type ? '$' : 'Rp' }})</small>
                    </td>
                </tr>
                <tr>
                    <td class="m-0 p-0" align="left" style="font-size: 12px">
                        {{ Str::upper('Gaji Pokok') }}
                    </td>
                    <td class="m-0 p-0" align="left">
                        <b>{{ number_format($payroll->basic_salary, 0, '.', '.') }}</b>
                    </td>
                </tr>
                @php
                    $earnTotal = 0;
                @endphp
                @foreach ($payroll->earn as $item)
                    @php
                        $earnTotal += $item->number;
                    @endphp
                    <tr>
                        <td class="m-0 p-0" align="left" style="font-size: 12px">
                            {{ $item->detail->name }}
                        </td>
                        <td class="m-0 p-0" align="left" style="font-weight: bold">
                            {{ number_format($item->value, 0, '.', '.') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px dotted rgb(0, 0, 0);border-top:none">
                    <td class="text-bold m-0 p-0" align="left" style="padding-bottom:0.5rem">
                        Deductions
                    </td>
                    <td class="text-bold m-0 p-0" align="left" style="padding-bottom:0.5rem">
                        Amount <small>({{ $payroll->employee->currency_type ? '$' : 'Rp' }})</small>
                    </td>
                </tr>
                @php
                    $deductionTotal = 0;
                @endphp
                @foreach ($payroll->deduction as $item)
                    <tr>
                        <td class="m-0 p-0" align="left" style="font-size: 12px">
                            {{ $item->detail->name }}
                        </td>
                        <td class="m-0 p-0" align="left" style="font-weight: bold">
                            {{ number_format($item->number, 0, '.', '.') }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px dotted rgb(0, 0, 0);border-top:none">
                    <td class="text-bold m-0 p-0" align="center" style="padding-bottom:0.5rem">
                        OT/Shift. Ex
                    </td>
                    <td class="text-bold m-0 p-0" align="right" style="padding-bottom:0.5rem">
                        Balance
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                    </td>
                </tr>
                @if ($payroll->overtime_count > 0)
                    @php
                        $overtimeTotal = 0;
                    @endphp
                    @foreach ($payroll->overtime as $item)
                        <tr>
                            <td class="m-0 p-0" align="center" style="font-size: 12px">
                                {{ $item->detail->name }}
                            </td>
                            <td class="m-0 p-0" align="right">
                                <small style="font-weight: bold">
                                    {{ number_format($item->value, 0, '.', '.') }}
                                </small>
                                ({{ $item->hour }})
                                @php
                                    $overtimeTotal += $item->hour;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($overtimeTypes as $item)
                        <tr>
                            <td class="m-0 p-0" align="center" style="font-size: 12px">
                                {{ $item->name }}
                            </td>
                            <td class="m-0 p-0" align="right">
                                0
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="2">
                        <br>
                    </td>
                </tr>
                @if ($payroll->shift_exc_count > 0)
                    @php
                        $shift_excTotal = 0;
                    @endphp
                    @foreach ($payroll->shiftExc as $item)
                        <tr>
                            <td class="m-0 p-0" align="center" style="font-size: 12px">
                                {{ $item->detail->name }}
                            </td>
                            <td class="m-0 p-0" align="right">
                                <small style="font-weight: bold">
                                    {{ number_format($item->value, 0, '.', '.') }}
                                </small>
                                ({{ $item->hour }})
                                @php
                                    $shift_excTotal += $item->hour;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($shiftExcTypes as $item)
                        <tr>
                            <td class="m-0 p-0" align="center" style="font-size: 12px">
                                {{ $item->name }}
                            </td>
                            <td class="m-0 p-0" align="right">
                                0
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="2">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td class="m-0 p-0" align="center" style="font-size: 12px">
                        Day Deductions
                    </td>
                    <td class="m-0 p-0" align="right">
                        {{ $item->deduction_days ?? 0 }}
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="add-detail"
        style="border-top:2px dotted rgb(0, 0, 0);border-bottom:2px dotted rgb(0, 0, 0); padding-top: 4px; padding-bottom: 4px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="text-bold m-0 p-0" align="left" width="10%">
                    Total :
                </td>
                <td class="text-bold m-0 p-0" align="right" width="25%">
                    {{ \Akaunting\Money\Money::IDR($payroll->total_earn) }}
                </td>
                <td class="text-bold m-0 p-0" align="right" style="color:red" width="40%">
                    {{ \Akaunting\Money\Money::IDR($payroll->total_deduction) }}
                </td>
                <td class="text-bold m-0 p-0" align="right" width="20%">
                    Net Salary
                </td>
                <td class="text-bold m-0 p-0" align="right" width="20%">
                    {{ \Akaunting\Money\Money::IDR($payroll->net_salary) }}
                </td>
            </tr>
        </table>
        <div style="clear: both;"></div>
    </div>

    <div class="add-detail">
        <div class="float-left" width="50%">
            <i style="font-size: 12px">
                Date/Tanggal : {{ now()->isoFormat('LLLL') }}
            </i>
        </div>
    </div>



</html>

<!DOCTYPE html>
<html>

<head>
    <title>{{ Str::slug($slip->thr->name . ' ' . $slip->employee->code) }}</title>
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

    .w-60 {
        width: 60%;
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
                <h1>{{ $slip->thr->company }}</h1>
            </td>
            <td class="m-0 p-0 w-15" align="right">
                <img src="{{ public_path('images/logo-birla.png') }}" alt="" style="width: 120px;">
            </td>
        </tr>
    </table>
    <div style="clear: both;" class="m-0 p-0"></div>
    <div class="w-100"
        style="border-top:none;border-bottom:2px solid rgb(0, 0, 0);padding-top: 4px; padding-bottom: 4px;margin-bottom:5px">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td class="m-0 p-0" align="left">
                    {{ $slip->thr->company }}
                </td>
                <td class="m-0 p-0" align="right">
                    <small>Pay Slip THR for the month of : {{ $slip->thr->name }}</small>
                </td>
            </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
    <div class="w-60 float-left ">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
            <tr>
                <td class="m-0 p-0" align="left" width="15%">
                    <small>Emp. Cd</small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->code }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left" width="15%">
                    <small>Name</small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->full_name }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>
                        Designation
                    </small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->designation->name }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>Grade</small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->grade->name }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>Dept</small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->department->name }}
                    </small>
                </td>
            </tr>
        </table>
    </div>
    <div class="w-40 float-left ">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>
                        Jamsostek
                    </small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->jamsostek }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>
                        Child
                    </small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->child }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>
                        Dependent
                    </small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->dependent }}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="m-0 p-0" align="left">
                    <small>
                        NPWP No
                    </small>
                </td>
                <td style="padding-right: 0.3rem" align="right" width="10%">
                    :
                </td>
                <td class="m-0 p-0" align="left">
                    <small class="text-bold">
                        {{ $slip->employee->npwp }}
                    </small>
                </td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>
    {{-- detail amount and deductions --}}
    <div class="add-detail mt-10" style="border-top:2px solid rgb(0, 0, 0);border-bottom:none; margin-top: 1rem;">
        <div class="w-40 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="text-bold m-0 p-0" align="left" style="padding:0.5rem; text-align: center">
                        <small>
                            Earning/Pendapatan
                        </small>
                    </td>
                </tr>
            </table>
            <div style="clear: both;"></div>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
                <tr>
                    <td style="padding: 0.5rem 0 0.5rem 0" class="m-0 p-0" align="left">
                        <small>
                            Basic/Gaji Pokok
                        </small>
                    </td>
                    <td align="right" width="5%">
                        :
                    </td>
                    <td class="m-0 p-0" align="right">
                        <small class="text-bold">
                            {{ number_format($data->basic, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0 0.5rem 0" class="m-0 p-0" align="left">
                        <small>
                            Allowance/Tunjangan
                        </small>
                    </td>
                    <td align="right" width="5%">
                        :
                    </td>
                    <td class="m-0 p-0" align="right" style="border-bottom:1px solid rgb(0, 0, 0);border-top:none"
                        width="40%">
                        <small class="text-bold">
                            {{ number_format($data->allowance, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0 0.5rem 0" class="m-0 p-0" align="left">
                        <small>
                            Gross Amount/Jumlah Bruto
                        </small>
                    </td>
                    <td align="right" width="5%">
                        :
                    </td>
                    <td class="m-0 p-0" align="right" style="border-bottom:1px solid rgb(0, 0, 0);border-top:none">
                        <small class="text-bold">
                            {{ number_format($data->gross, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem 0 0.5rem 0" class="m-0 p-0" align="left">
                        <small>
                            Incentive/THR ({{ $data->incentive_percent * 100 }}%)
                        </small>
                    </td>
                    <td align="right" width="5%">
                        :
                    </td>
                    <td class="m-0 p-0" align="right">
                        <small class="text-bold">
                            {{ number_format($data->incentive, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>

            </table>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="text-bold m-0 p-0" align="left" style="padding:0.5rem; text-align: center">
                        <small>
                            Deductions/Potongan
                        </small>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border: none; ">
                <tr>
                    <td style="padding: 0.5rem 0 0.5rem 0" class="m-0 p-0" align="center">
                        <small>
                            Tax/Pajak ({{ $data->tax_percent * 100 }}%)
                        </small>
                    </td>
                    <td align="right" width="5%">
                        :
                    </td>
                    <td class="m-0 p-0" align="right">
                        <small class="text-bold">
                            {{ number_format($data->tax, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>

            </table>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="text-bold m-0 p-0" align="left" style="padding:0.5rem; text-align: center">
                        -
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div style="clear: both;"></div>

    <div class="add-detail mt-10" style="border-top:2px solid rgb(0, 0, 0);border-bottom:none; margin-top: 1rem;">
        <div class="w-40 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="m-0 p-0" align="left" style="padding:0.5rem; text-align: left">
                        <small>
                            Amount Calc
                        </small>
                    </td>
                    <td class="m-0 p-0" align="right">
                        <small class="text-bold" style="color: blue">
                            {{ number_format($data->incentive, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="m-0 p-0" style="padding: 0.5rem 0 0.5rem 0" align="center">
                        <small>
                            Deduction/Potongan
                        </small>
                    </td>

                    <td class="m-0 p-0" align="right">
                        <small class="text-bold" style="color: red">
                            {{ number_format($data->tax, 0, '.', '.') }}
                        </small>
                    </td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>
        <div class="w-30 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr style="border-bottom:2px solid rgb(0, 0, 0);border-top:none">
                    <td class="m-0 p-0" style="padding: 0.5rem 0 0.5rem 0" align="right">
                        <small>
                            Net Amount
                        </small>
                    </td>

                    <td class="m-0 p-0" align="right">
                        <span class="text-bold" style="font-size: 18px">
                            {{ \Akaunting\Money\Money::IDR($data->take_home_pay) }}
                        </span>
                    </td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>
    </div>

    <div class="add-detail" style="margin-top: 3rem">
        <div class="float-left" width="50%">
            <small>
                <i>
                    Print Date : {{ now()->isoFormat('LLLL') }}
                </i>
            </small>
        </div>
    </div>



</html>

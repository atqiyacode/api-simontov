<!DOCTYPE html>
<html>

<head>
    <title>
        Invoice
    </title>
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

    .p-2 {
        padding: 2rem;
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
            <td class="m-0 p-0 w-10" align="center">
                {{-- <img src="{{ asset('logo/logo-kim.png') }}" alt="" style="width: 120px;"> --}}
            </td>
            <td class="m-0 p-0 w-80" align="center">
                <h2 style="margin-top: 1rem; margin-bottom: 0">
                    {{ $template->company_name }}
                </h2>
                {{-- <h4 style="margin-top: 0">
                    WISMA KAWASAN INDUSTRI MEDAN
                </h4> --}}
            </td>
            <td class="m-0 p-0 w-10" align="center">
                <h3 style="border:2px outset rgb(0, 0, 0); padding:8px">
                    INVOICE
                </h3>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="m-0 p-0" align="center">
                <p class="font-bold" style="font-size: 15px; font-weight: bolder; margin-bottom: 0px">
                    {{ $template->company_address }}
                </p>
                <span class="font-bold" style="font-size: 14px; margin-bottom: 0px">
                    <b>Phone</b> : {{ $template->phone }} | <b>Fax</b> : {{ $template->fax }} | <b>NPWP</b> :
                    {{ $template->npwp }}
                </span>
            </td>

        </tr>
    </table>

    <div style="clear: both;" class="m-0 p-0"></div>
    <div class="w-100"
        style="border-top:none;border-bottom:2px outset rgb(0, 0, 0);padding-top: 4px; padding-bottom: 4px;margin-bottom:5px">
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="m-0 p-0 w-60" align="left">
                <p class="p-0 m-0">
                    To :
                    <br>
                    <b>{{ $tenant->name }}</b>
                </p>
                <p class="p-0 m-0">
                    NPWP :
                    <br>
                    <b>
                        {{ $tenant->npwp }}
                    </b>
                </p>
                <p class="p-0 m-0">
                    Address :
                    <br>
                    <b>
                        {{ $tenant->address }}
                    </b>
                </p>
            </td>
            <td class="m-0 p-0 w-40" align="right">
                <p class="p-0 m-0">
                    Invoice No : <b>1044/KIM/SLI/06/23</b>
                </p>
                <p class="p-0 m-0">
                    Invoice Date : <b>{{ $data['start_date'] }}</b>
                </p>
                <p class="p-0 m-0">
                    Due Date : <b>{{ $data['end_date'] }}</b>
                </p>
            </td>
        </tr>
    </table>

    <div style="clear: both;"></div>
    <div class="add-detail mt-10" style="border:2px outset rgb(0, 0, 0); padding: 4px; margin-top: 2rem">
        <div class="w-100 float-left mt-10">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td class="text-bold m-0 p-0" align="left"
                        style="font-size:16px;padding-bottom:0.5rem;border-bottom:2px outset rgb(0, 0, 0);border-top:none;">
                        Description
                    </td>
                    <td class="text-bold m-0 p-0" align="center"
                        style="font-size:16px;padding-bottom:0.5rem;border-bottom:2px outset rgb(0, 0, 0);border-top:none;">
                        Quantity (m<sup>3</sup>)
                    </td>
                    <td class="text-bold m-0 p-0" align="center"
                        style="font-size:16px;padding-bottom:0.5rem;border-bottom:2px outset rgb(0, 0, 0);border-top:none;">
                        Price (Rp)
                    </td>
                    <td class="text-bold m-0 p-0" align="right"
                        style="font-size:16px;padding-bottom:0.5rem;border-bottom:2px outset rgb(0, 0, 0);border-top:none;">
                        Amount (Rp)
                    </td>
                </tr>
                <tr>
                    <td class="m-0 p-0" align="left" style="padding-bottom:0.5rem;padding-top:0.5rem;">
                        Waste Water
                        <br>
                        <small>
                            Lorem ipsum dolor sit amet.
                        </small>
                    </td>
                    <td class="m-0 p-0" align="center" style="padding-bottom:0.5rem;padding-top:0.5rem;">
                        {{ number_format($data['last']->totalizer_1 - $data['first']->totalizer_1) }} m<sup>3</sup>
                    </td>
                    <td class="m-0 p-0" align="center" style="padding-bottom:0.5rem;padding-top:0.5rem;">
                        {{ number_format($price) }}
                    </td>
                    <td class="m-0 p-0" align="right" style="padding-bottom:0.5rem;padding-top:0.5rem;">
                        {{ number_format($billing) }}
                    </td>
                </tr>

                <tr>
                    <td class="m-0 p-0" align="right" colspan="2"
                        style="font-size:15px;border-top:2px outset rgb(0, 0, 0);">
                    </td>
                    <td class="text-bold m-0 p-0" align="right"
                        style="font-size:15px;border-top:2px outset rgb(0, 0, 0);">
                        Sub total
                    </td>
                    <td class="m-0 p-0" align="right" style="font-size:15px;border-top:2px outset rgb(0, 0, 0);">
                        {{ number_format($billing) }}
                    </td>
                </tr>
                <tr>
                    <td class="m-0 p-0" align="right" colspan="2" style="font-size:15px;">

                    </td>
                    <td class="text-bold -0 p-0" align="right" style="font-size:15px;">
                        Add. Cost/Discount*
                    </td>
                    <td class="m-0 p-0" align="right" style="font-size:15px;">
                        {{ number_format($tax->value) }}
                    </td>
                </tr>
                <tr>
                    <td class="text-bold m-0 p-0" align="right" colspan="2"
                        style="font-size:16px;padding-top:1rem;">
                    </td>
                    <td class="text-bold m-0 p-0" align="right" style="font-size:18px; padding-top:1rem;">
                        Grand Total
                    </td>
                    <td class="text-bold m-0 p-0" align="right" style="font-size:18px; padding-top:1rem;">
                        {{ number_format($billing + $tax->value) }}
                    </td>
                </tr>
            </table>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div style="clear: both;"></div>
    <div style="clear: both;"></div>
    <div style="font-size: 12px;">
        {!! $template->additional_section !!}
    </div>

    <div style="clear: both;"></div>

    <div class="w-100"
        style="border-top:none;border-bottom:0.5px outset rgb(0, 0, 0);padding-top: 2px; padding-bottom: 2px;margin-bottom:5px">
    </div>

    <div style="clear: both;"></div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="m-0 p-0 w-50" align="center">
                <p class="text-bold">Received by,</p>
                <p style="padding-top: 2rem;margin-bottom: 0px;font-size: 13px;" class="text-bold">
                    ({{ $tenant->pic }})
                </p>
                <small style="padding-top: 0">
                    Manager
                </small>
            </td>
            <td class="m-0 p-0 w-50" align="center">
                <p class="text-bold">
                    {{ $template->company_name }}
                </p>
                <p style="padding-top: 2rem;margin-bottom: 0px;font-size: 13px;" class="text-bold">
                    ({{ $template->manager_name }})
                </p>
                <small style="padding-top: 0">
                    Manager
                </small>
            </td>
        </tr>
    </table>

    {!! $template->note !!}

    {{-- <div style="font-size: 12px; margin-top: 2rem; margin-left: 0.5rem;">
        <p style="margin:0px;" class="text-bold">
            PENTING
        </p>
        <ul style="list-style-type: decimal; margin:0;">
            <li>
                Lorem ipsum dolor sit amet.
            </li>
            <li>
                Lorem ipsum dolor sit amet.
            </li>
            <li>
                Lorem ipsum dolor sit amet.
            </li>
        </ul>
    </div>

    <div style="font-size: 12px; margin-top: 0.5rem; margin-left: 0.5rem;">
        <p style="margin:0px;" class="text-bold">
            Silahkan melakukan pembayaran sebelum tanggal kadaluarsa diatas dengan menggunakan nomor virtual account
            dibawah ini sebagai rekening tujuan transfer
        </p>
        <ul style="list-style-type: none; margin-top:0.5rem;">
            <li>
                Virtual account BNI : <span class="text-bold">1234567890</span>
            </li>
            <li>
                Virtual account Mandiri : <span class="text-bold">1234567890</span>
            </li>
        </ul>
    </div> --}}

    {{-- <div class="add-detail">
        <div class="float-left" width="50%">
            <i style="font-size: 12px">
                Date/Tanggal : {{ now()->isoFormat('LLLL') }}
            </i>
        </div>
    </div> --}}



</html>

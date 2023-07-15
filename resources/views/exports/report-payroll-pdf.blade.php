<!DOCTYPE html>
<html>

<head>
    <title>{{ $fileName }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>

    <table class='table table-borderless '>
        <thead>
            <tr>
                <th class="text-left" style="font-size: 12pt">
                    Company : {{ $header['month']->company }}
                    <br>
                    Payslip Month : {{ $header['month']->name }}
                    <br>
                    Designation : {{ $header['designation']->name ?? 'All Designation' }}
                    <br>
                    Grade : {{ $header['grade']->name ?? 'All Grade' }}
                    <br>
                    Department : {{ $header['department']->name ?? 'All Department' }}
                </th>
            </tr>
        </thead>
    </table>

    <table class='table table-bordered '>
        <thead>
            <tr>
                <th>No</th>
                <th>Emp. Code</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Grade</th>
                <th>Department</th>
                <th class="text-right">Basic Salary</th>
                <th class="text-right">Total Earn</th>
                <th class="text-right">Total Ded.</th>
                <th class="text-right">Net Salary</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->employee->code }}</td>
                    <td>{{ $item->employee->full_name }}</td>
                    <td>{{ $item->employee->designation->name }}</td>
                    <td>{{ $item->employee->grade->name }}</td>
                    <td>{{ $item->employee->department->name }}</td>
                    @if ($item->employee->currency_type == 1)
                        <td
                            class="text-right @if ($grandTotal['max_basic_salary'] == $item->basic_salary) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::USD($item->basic_salary) }}
                        </td>
                        <td
                            class="text-right @if ($grandTotal['max_total_earn'] == $item->total_earn) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::USD($item->total_earn) }}
                        </td>
                        <td
                            class="text-right @if ($grandTotal['max_total_deduction'] == $item->total_deduction) font-weight-bold text-white bg-danger @endif">
                            {{ \Akaunting\Money\Money::USD($item->total_deduction) }}
                        </td>
                        <td
                            class="text-right  @if ($grandTotal['max_net_salary'] == $item->net_salary) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::USD($item->net_salary) }}
                        </td>
                    @else
                        <td
                            class="text-right @if ($grandTotal['max_basic_salary'] == $item->basic_salary) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::IDR($item->basic_salary) }}
                        </td>
                        <td
                            class="text-right @if ($grandTotal['max_total_earn'] == $item->total_earn) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::IDR($item->total_earn) }}
                        </td>
                        <td
                            class="text-right @if ($grandTotal['max_total_deduction'] == $item->total_deduction) font-weight-bold text-white bg-danger @endif">
                            {{ \Akaunting\Money\Money::IDR($item->total_deduction) }}
                        </td>
                        <td
                            class="text-right  @if ($grandTotal['max_net_salary'] == $item->net_salary) font-weight-bold text-white bg-success @endif">
                            {{ \Akaunting\Money\Money::IDR($item->net_salary) }}
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr>
                @if ($data[0]->employee->currency_type)
                    <td colspan="6" class="font-weight-bold text-center">Grand Total</td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::USD($grandTotal['basic_salary']) }}
                    </td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::USD($grandTotal['total_earn']) }}
                    </td>
                    <td class="text-right font-weight-bold text-danger">
                        {{ \Akaunting\Money\Money::USD($grandTotal['total_deduction']) }}
                    </td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::USD($grandTotal['net_salary']) }}
                    </td>
                @else
                    <td colspan="6" class="font-weight-bold text-center">Grand Total</td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::IDR($grandTotal['basic_salary']) }}
                    </td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::IDR($grandTotal['total_earn']) }}
                    </td>
                    <td class="text-right font-weight-bold text-danger">
                        {{ \Akaunting\Money\Money::IDR($grandTotal['total_deduction']) }}
                    </td>
                    <td class="text-right font-weight-bold text-success">
                        {{ \Akaunting\Money\Money::IDR($grandTotal['net_salary']) }}
                    </td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="float-left" width="100%">
        <i style="font-size: 12px">
            Print Detail : {{ auth()->user()->name }} - {{ now()->isoFormat('LLLL') }}
        </i>
    </div>

</body>

</html>

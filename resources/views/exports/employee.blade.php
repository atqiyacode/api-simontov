<!DOCTYPE html>
<html>

<head>
    <title>Export PDF by tricitta</title>
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

    <table class='table table-bordered '>
        <thead>
            <tr>
                <th>No</th>
                @if (auth()->user()->hasRole('superadmin'))
                    <th>
                        NIK
                    </th>
                @endif
                <th>Code</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Has Account</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if (auth()->user()->hasRole('superadmin'))
                        <td>{{ strval($item->nik) }}</td>
                    @endif
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->grade->name }}</td>
                    <td>{{ $item->designation->name }}</td>
                    <td>{{ $item->department->name }}</td>
                    <td>{{ $item->account ? 'Registered' : 'Not Registered' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

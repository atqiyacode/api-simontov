<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

    <table class='table table-bordered '>
        <thead>
            <tr>
                <th>No</th>
                <th>Company</th>
                <th>Month</th>
                <th>Employee Code</th>
                <th>Employee Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->month->company }}</td>
                    <td>{{ $item->month->name }}</td>
                    <td>{{ $item->employee->code }}</td>
                    <td>{{ $item->employee->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

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
                <th>Village Code</th>
                <th>Village Name</th>
                <th>Province Code</th>
                <th>Province Name</th>
                <th>City Code</th>
                <th>City Name</th>
                <th>District Code</th>
                <th>District Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->province->id }}</td>
                    <td>{{ $item->province->name }}</td>
                    <td>{{ $item->city->id }}</td>
                    <td>{{ $item->city->name }}</td>
                    <td>{{ $item->district->id }}</td>
                    <td>{{ $item->district->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

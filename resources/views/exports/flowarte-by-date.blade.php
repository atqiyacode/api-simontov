<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">No</th>
            <th style="font-weight: bold;">DATE</th>

            <th style="font-weight: bold;">
                FLOWRATE
            </th>
            {{-- <th style="font-weight: bold;">
                PRESSURE
            </th> --}}

            <th style="font-weight: bold;">TOTALIZER 1</th>
            <th style="font-weight: bold;">TOTALIZER 2</th>
            <th style="font-weight: bold;">TOTALIZER 3</th>

            {{-- <th style="font-weight: bold;">
                ANALOG 1
            </th>
            <th style="font-weight: bold;">
                STATUS BATTERY
            </th>

            <th style="font-weight: bold;">
                ALARM
            </th>

            <th style="font-weight: bold;">
                BINARY ALARM
            </th> --}}

            <th style="font-weight: bold;">PH</th>
            <th style="font-weight: bold;">COD</th>
            {{-- <th style="font-weight: bold;">COND</th>
            <th style="font-weight: bold;">LEVEL</th>
            <th style="font-weight: bold;">DO</th>

            <th style="font-weight: bold;">FILE NAME</th> --}}

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->mag_date }}</td>

                <td>{{ $item->flowrate }}</td>
                {{-- <td>{{ $item->pressure }}</td> --}}

                <td>{{ $item->totalizer_1 }}</td>
                <td>{{ $item->totalizer_2 }}</td>
                <td>{{ $item->totalizer_3 }}</td>

                {{-- <td>{{ $item->analog_1 }}</td>
                <td>{{ $item->status_battery }}</td>

                <td>{{ $item->alarm }}</td>
                <td>{{ $item->bin_alarm }}</td> --}}

                <td>{{ $item->ph }}</td>
                <td>{{ $item->cod }}</td>
                {{-- <td>{{ $item->cond }}</td>
                <td>{{ $item->level }}</td>
                <td>{{ $item->do }}</td>

                <td>{{ $item->file_name }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

{{-- 'totalizer_1',
        'totalizer_2',
        'totalizer_3',

        'unit_flowrate',
        'unit_totalizer',

        'flowrate',
        'pressure',

        'analog_1',
        'status_battery',
        'alarm',

        'bin_alarm',

        'file_name',

        'ph',
        'cod',
        'cond',
        'level',
        'do',

        'do_alarm_hi',
        'do_alarm_lo',
        'pres_alarm_hi',
        'pres_alarm_lo',
        'ph_alarm_hi',
        'ph_alarm_lo',

        'fm_status',
        'fm_err_code',

        'pln_stat',
        'panel_stat', --}}

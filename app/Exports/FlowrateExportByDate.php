<?php

namespace App\Exports;

use App\Models\Flowrate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class FlowrateExportByDate implements FromView
{
    protected $locationId, $start, $end, $month_start, $month_end, $interval;

    public function __construct($locationId, $start, $end, $month_start, $month_end, $interval)
    {
        $this->locationId = $locationId;
        $this->start = $start;
        $this->end = $end;
        $this->month_start = $month_start;
        $this->month_end = $month_end;
        $this->interval = $interval;
    }

    public function view(): View
    {
        $data = $this->filterQuery($this->locationId)->get();
        return view('exports.flowarte-by-date', [
            'data' => $data
        ]);
    }

    public function filterQuery($id)
    {
        if ($this->interval === 'month') {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m") ORDER BY mag_date DESC) as row_num
            FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
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
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)

                ->whereBetween('mag_date', [$this->month_start, $this->month_end])
                ->orderBy('interval', 'ASC');
        } elseif ($this->interval === 'day') {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m-%d") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m-%d") ORDER BY mag_date DESC) as row_num
        FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
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
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)

                ->whereBetween('mag_date', [$this->start, $this->end])
                ->orderBy('interval', 'ASC');
        } else {
            $results = DB::table(DB::raw('(
        SELECT
            id,
            location_id,

            mag_date,

            totalizer_1,
            totalizer_2,
            totalizer_3,

            unit_flowrate,
            unit_totalizer,

            flowrate,
            pressure,

            analog_1,
            status_battery,
            alarm,

            bin_alarm,

            file_name,

            ph,
            cod,
            cond,
            level,
            do,

            do_alarm_hi,
            do_alarm_lo,
            pres_alarm_hi,
            pres_alarm_lo,
            ph_alarm_hi,
            ph_alarm_lo,

            fm_status,
            fm_err_code,

            pln_stat,
            panel_stat,

            created_at,
            updated_at,


            DATE_FORMAT(mag_date, "%Y-%m-%d %H:00:00") as `interval`,
            ROW_NUMBER() OVER (PARTITION BY DATE_FORMAT(mag_date, "%Y-%m-%d %H:00:00") ORDER BY mag_date DESC) as row_num
            FROM flowrates where location_id = ' . $id . '
    ) as ranked'))
                ->select(
                    'id',
                    'location_id',

                    'mag_date',

                    'totalizer_1',
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
                    'panel_stat',

                    'created_at',
                    'updated_at',


                )
                ->where('row_num', 1)

                ->whereBetween('mag_date', [$this->start, $this->end])
                ->orderBy('interval', 'ASC');
        }

        return $results;
    }
}

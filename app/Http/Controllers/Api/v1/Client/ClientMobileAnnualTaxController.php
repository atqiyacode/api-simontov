<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Client\ClientAnnualTaxResource;
use App\Models\v1\AnnualTaxEmployee;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;
use File;

class ClientMobileAnnualTaxController extends Controller
{
    use ApiResponseHelpers;

    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/employee-tax');
    }

    public function index(Request $request)
    {
        $keyword = $request->search;
        $query = AnnualTaxEmployee::withCount([
            'annual_tax'
        ])
            ->when($request->has('search'), function ($q) use ($keyword) {
                $q->where('pph_21', 'LIKE', "%{$keyword}%");
            })
            ->currentUser()
            ->orderBy('id', 'DESC')
            ->paginate();
        $data = ClientAnnualTaxResource::collection($query);
        return $data;
    }

    public function download(Request $request, $id)
    {
        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path, 0775, true, true);
        }
        $data = AnnualTaxEmployee::with(['annual_tax'])->currentUser()->where('id', $id)->firstOrFail();
        $pph_21 = json_decode($data->pph_21);
        $filename = $data->employee_code . "-" . $pph_21->nama . "-" . $pph_21->nomor_bukti_potong;
        $filePath = public_path("sample-file/NEW-TEMPLATE-A1.pdf");

        $outputFilePath = public_path('storage/employee-tax/' . $filename . ".pdf");

        $this->fillPDFFile($filePath, $outputFilePath, $data);
        return response()->download($outputFilePath);
    }

    public function getFormatedCode($code)
    {
        $ret = substr($code, 0, 1) . '  .  '
            . substr($code, 1, 1) . '  -  '
            . substr($code, 2, 2) . '  .  '
            . substr($code, 4, 2) . '  -  '
            . substr($code, 5, 7);
        return $ret;
    }

    public function getFormatedNPWP($npwp)
    {
        $ret = substr($npwp, 0, 2) . '  .  '
            . substr($npwp, 2, 3) . '  .  '
            . substr($npwp, 5, 3) . '  .  '
            . substr($npwp, 8, 1) . '  -  '
            . substr($npwp, 9, 3) . '  .  '
            . substr($npwp, 12, 3);
        return $ret;
    }

    public function fillPDFFile($file, $outputFilePath, $data)
    {
        $pph_21 = json_decode($data->pph_21);

        $fpdi = new FPDI;

        $count = $fpdi->setSourceFile($file);

        for ($i = 1; $i <= $count; $i++) {

            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $fpdi->SetFont("Arial", "B", 11);
            $fpdi->SetTextColor(0, 0, 0);

            // nomor bukti potong
            $fpdi->Text(80, 56, $this->getFormatedCode(Str::replace(['.', '-'], '', $pph_21->nomor_bukti_potong)));
            // masa perolehan
            $fpdi->SetFont("Arial", "B", 11);
            $fpdi->Text(173, 56, strlen($pph_21->masa_perolehan_awal) > 1 ? $pph_21->masa_perolehan_awal : '0' . $pph_21->masa_perolehan_awal);
            $fpdi->Text(195, 56, strlen($pph_21->masa_perolehan_akhir) > 1 ? $pph_21->masa_perolehan_akhir : '0' . $pph_21->masa_perolehan_akhir);

            $fpdi->SetFont("Arial", "B", 11);
            // npwp pemotong
            $npwpPemotong = Str::replace('.', '', $data->annual_tax->npwp_pemotong);
            $fpdi->Text(43, 66, $this->getFormatedNPWP($npwpPemotong));
            // nama pemotong
            $fpdi->Text(43, 75, $data->annual_tax->nama_pemotong);

            // IDENTITAS PENERIMA PENGHASILAN YANG DIPOTONG
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->Text(38, 95, $this->getFormatedNPWP($pph_21->npwp));
            $fpdi->Text(38, 103, $pph_21->nik);
            $fpdi->Text(38, 110, $pph_21->nama);
            $fpdi->SetFont("Arial", "B", 8);
            $alamat = Str::length($pph_21->alamat);
            if ($alamat > 53) {
                $fpdi->Text(38, 116, Str::substr($pph_21->alamat, 0, -($alamat - 53)));
                $fpdi->Text(38, 119, Str::substr($pph_21->alamat, 53));
            } else {
                $fpdi->Text(38, 116, $pph_21->alamat);
            }
            // jenis kelamin
            $fpdi->SetFont("Arial", "B", 10);
            $fpdi->Text($pph_21->jenis_kelamin == 'M' ? 49.25 : 71.6, 128, 'X');

            // status ptkkp
            $fpdi->SetFont("Arial", "B", 9);
            switch ($pph_21->status_ptkp) {
                case 'K':
                    $fpdi->Text(144, 103, $pph_21->jumlah_tanggungan);
                    break;
                case 'TK':
                    $fpdi->Text(161, 103, $pph_21->jumlah_tanggungan);
                    break;
                case 'HB':
                    $fpdi->Text(179, 103, $pph_21->jumlah_tanggungan);
                    break;
                default:
                    break;
            }

            $fpdi->SetFont("Arial", "B", 6);
            $fpdi->Text(163, 110, $pph_21->nama_jabatan);
            // wp_luar_negeri
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->Text(168, 116, $pph_21->wp_luar_negeri != 'N' ? 'X' : null);
            // kode_negara
            $fpdi->SetFont("Arial", "B", 9);
            $fpdi->Text(174, 121.75, $pph_21->kode_negara);
            // kode_pajak
            $fpdi->SetFont("Arial", "B", 9);
            switch ($pph_21->kode_pajak) {
                case '21-100-01':
                    $fpdi->Text(52, 149, 'X');
                    break;
                case '21-100-02':
                    $fpdi->Text(80, 149, 'X');
                    break;
                default:
            }
            // jumlah data
            $fpdi->SetFont("Arial", "B", 8, 'R');
            $fpdi->ln(146);
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_1, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_2, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_3, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_4, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_5, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_6, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_7, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_8, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, '', 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_9, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_10, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_11, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, '', 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_12, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_13, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_14, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_15, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_16, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 5, number_format($pph_21->jumlah_17, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_18, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_19, 0, ',', '.'), 0, 1, 'R');
            $fpdi->Cell(199, 4.5, number_format($pph_21->jumlah_20, 0, ',', '.'), 0, 1, 'R');

            $fpdi->SetFont("Arial", "B", 11);
            // npwp_pemotong
            $fpdi->Text(34, 276, $this->getFormatedNPWP($pph_21->npwp_pemotong));

            // nama_pemotong
            $fpdi->Text(34, 285, $pph_21->nama_pemotong);

            $tanggalBuktiPotong = Str::replace('/', '   -   ', $pph_21->tanggal_bukti_potong);

            $fpdi->Text(128, 285, $tanggalBuktiPotong);


            $fpdi->Image(public_path('sample-file/arpit-01.png'), 170, 260);
            $fpdi->Image(public_path('sample-file/company-01.png'), 170, 288);
        }

        return $fpdi->Output($outputFilePath, 'F');
    }
}

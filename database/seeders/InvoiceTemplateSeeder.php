<?php

namespace Database\Seeders;

use App\Models\InvoiceTemplate;
use Illuminate\Database\Seeder;

class InvoiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        InvoiceTemplate::create([
            'company_name' => 'PT. KAWASAN INDUSTRI MEDAN',
            'company_address' => 'Jalan Pulau Batam No. 1 Kompleks KIM Tahap II Saentis Percut Sei Tuan - Deli Serdang 20371',
            'phone' => '(061) 6871177',
            'fax' => '(061) 6871088',
            'npwp' => '01.467.610.0-093.000 - 01.467.610.0.0.0-125.001',
            'additional_section' => '
            <p style="color: red; margin-top:1rem; margin-bottom: 0.5rem;">
            *) Additional Description
        </p>
        <ul style="list-style-type: decimal; margin:0;">
            <li>
                Additional
            </li>
        </ul>
            ',
            'manager_name' => 'Manager Name',
            'note' => '
            <div style="font-size: 12px; margin-top: 2rem; margin-left: 0.5rem;">
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
    </div>
            ',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'code' => "1",
                'company_name' => "SOCI MAS",
                'name' => "SOCI MAS",
                'longitude' => "98.67415940009602",
                'lattitude' => "3.6706589304529724",
                'description' => null,
            ],
            [
                'id' => 2,
                'code' => "2",
                'company_name' => "MUSIM MAS ( IPAL I )",
                'name' => "MUSIM MAS ( IPAL I )",
                'longitude' => "98.68744894094397",
                'lattitude' => "3.6710688087429326",
                'description' => null,
            ],
            [
                'id' => 3,
                'code' => "3",
                'company_name' => "MUSIM MAS ( IPAL II )",
                'name' => "MUSIM MAS ( IPAL II )",
                'longitude' => "98.68744354535087",
                'lattitude' => "3.6709705312877103",
                'description' => null,
            ],
            [
                'id' => 4,
                'code' => "4",
                'company_name' => "BANJAR MAKMUR SEJATI",
                'name' => "BANJAR MAKMUR SEJATI",
                'longitude' => "98.67401126022267",
                'lattitude' => "3.6671020244746657",
                'description' => null,
            ],
            [
                'id' => 5,
                'code' => "5",
                'company_name' => "MEDAN SUGAR INDUSTRI",
                'name' => "MEDAN SUGAR INDUSTRI",
                'longitude' => "98.69930503853348",
                'lattitude' => "3.671038320390449",
                'description' => null,
            ],
            [
                'id' => 6,
                'code' => "6",
                'company_name' => "CHAROEN POKPHAND INDONESIA",
                'name' => "CHAROEN POKPHAND INDONESIA",
                'longitude' => "98.69273904440274",
                'lattitude' => "3.677086433678571",
                'description' => null,
            ],
            [
                'id' => 7,
                'code' => "7",
                'company_name' => "PHPO",
                'name' => "PHPO",
                'longitude' => "98.69375007252167",
                'lattitude' => "3.6586512766047092",
                'description' => null,
            ],
            [
                'id' => 8,
                'code' => "8",
                'company_name' => "INTAN HAVEA",
                'name' => "INTAN HAVEA",
                'longitude' => "98.67334885260864",
                'lattitude' => "3.673883822617605",
                'description' => null,
            ],
            [
                'id' => 9,
                'code' => "9",
                'company_name' => "MEDAN CANNING",
                'name' => "MEDAN CANNING",
                'longitude' => "98.67380889720462",
                'lattitude' => "3.6661252275312175",
                'description' => null,
            ],
            [
                'id' => 10,
                'code' => "10",
                'company_name' => "RED RIBBON",
                'name' => "RED RIBBON",
                'longitude' => "98.67406425189289",
                'lattitude' => "3.6699166064211957",
                'description' => null,
            ],
            [
                'id' => 11,
                'code' => "11",
                'company_name' => "PASIFIC PALMINDO",
                'name' => "PASIFIC PALMINDO",
                'longitude' => "98.69061038459078",
                'lattitude' => "3.6699852566712514",
                'description' => null,
            ],
            [
                'id' => 12,
                'code' => "12",
                'company_name' => "CHAROEN POKPHAND DIV. FOOD",
                'name' => "CHAROEN POKPHAND DIV. FOOD",
                'longitude' => "98.66999124752013",
                'lattitude' => "3.6712832003213562",
                'description' => null,
            ],
            [
                'id' => 13,
                'code' => "13",
                'company_name' => "YAKITA MULIA",
                'name' => "YAKITA MULIA",
                'longitude' => "98.68834078005277",
                'lattitude' => "3.6676889828632198",
                'description' => null,
            ],
            [
                'id' => 14,
                'code' => "14",
                'company_name' => "OLEOCHEMICAL & SOAP INDUSTRY",
                'name' => "OLEOCHEMICAL & SOAP INDUSTRY",
                'longitude' => "98.68806747808475",
                'lattitude' => "3.6723959409246665",
                'description' => null,
            ],
            [
                'id' => 15,
                'code' => "15",
                'company_name' => "BANJAR MAKMUR SEJATI II",
                'name' => "BANJAR MAKMUR SEJATI II",
                'longitude' => "98.689228418388",
                'lattitude' => "3.6674155435762",
                'description' => null,
            ],
            [
                'id' => 16,
                'code' => "16",
                'company_name' => "PASIFIC MEDAN INDUSTRI 2",
                'name' => "PASIFIC MEDAN INDUSTRI 2",
                'longitude' => "98.6892235617311",
                'lattitude' => "3.6723264086090657",
                'description' => null,
            ],
            [
                'id' => 17,
                'code' => "17",
                'company_name' => "TOBA SURIMI KIM 1",
                'name' => "TOBA SURIMI KIM 1",
                'longitude' => "98.67299008369365",
                'lattitude' => "3.6666992312523057",
                'description' => null,
            ],
            [
                'id' => 18,
                'code' => "18",
                'company_name' => "VVF INDONESIA",
                'name' => "VVF INDONESIA",
                'longitude' => "98.70590639100264",
                'lattitude' => "3.667246898275956",
                'description' => null,
            ],
            [
                'id' => 19,
                'code' => "19",
                'company_name' => "MEDAN BAJAINDO",
                'name' => "MEDAN BAJAINDO",
                'longitude' => "98.6916540059987",
                'lattitude' => "3.6714152536598186",
                'description' => null,
            ],
            [
                'id' => 20,
                'code' => "20",
                'company_name' => "MUTIARA LAUT ABADI",
                'name' => "MUTIARA LAUT ABADI",
                'longitude' => "98.69472291601832",
                'lattitude' => "3.6774343227255213",
                'description' => null,
            ]
        ];
        Location::insert($data);
    }
}

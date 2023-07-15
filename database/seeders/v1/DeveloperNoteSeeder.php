<?php

namespace Database\Seeders\v1;

use App\Models\v1\DeveloperNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeveloperNoteSeeder extends Seeder
{
    // use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeveloperNote::updateOrCreate([
            'label' => 'Privacy Policy',
            'slug' => Str::slug('Privacy Policy'),
            'content' => 'PT TRICITTA SYNERGY membuat kebijakan privasi untuk mencerminkan komitmen Kami untuk melindungi privasi Anda. Sebagai Penyedia Layanan, Kami menjaga kerahasiaan dan keamanan data Anda. Kami menyimpan dan mengelola berbagai informasi pribadi, organisasi dan keuangan Anda untuk tujuan pengelolaan human resource, mencatat absensi, mengelola pengajuan sakit, izin dan cuti karyawan, penggajian, penghitungan pajak PPh 21 dan BPJS Anda hingga employee benefits.



I. Informasi yang Kami Kumpulkan



Informasi yang Kami kumpulkan meliputi informasi terkait perusahaan Anda, informasi terkait karyawan Anda dan informasi terkait aktivitas Anda dalam menggunakan Layanan. Informasi dan/atau Data Anda hanya digunakan untuk kepentingan penggunaan Layanan IBR Payroll ini. Dengan menggunakan Layanan ini, Anda menjamin bahwa Anda bertanggung jawab untuk mendapatkan persetujuan dari karyawan Anda bahwa informasi dan/atau data pribadi milik karyawan Anda Kami kumpulkan dan kelola dengan baik dan terjaga kerahasiaannya.



II. Informasi Anda yang Kami Gunakan pada Situs lain



Dengan menggunakan Layanan IBR Payroll, Anda dapat menikmati berbagai keuntungan dan manfaat untuk karyawan maupun perusahaan Anda melalui platform employee benefits yang dikelola oleh anak perusahaan Kami, PT TRICITTA SYNERGY, yaitu Platform tricitta.co.is yang terkoneksi dengan IBR Payroll, dalam hal Anda memutuskan untuk menggunakan Layanan pada Platform tricitta.co.is. Data Anda Kami bagikan pada Platform tricitta.co.is agar Anda dapat menggunakan Platform tricitta.co.is dengan nyaman tanpa perlu melakukan pengisian data pribadi Anda. Anda tidak perlu khawatir karena PT TRICITTA SYNERGY menggunakan standar keamanan dan kerahasian data yang sama seperti yang diterapkan IBR Payroll. Kami akan terus memantau dan mengawasi keamanan dan kerahasiaan data Anda selama pemakaian fasilitas employee benefits ini. Anda cukup Login dengan akun personalia IBR Payroll Anda dan nikmati benefits yang anda butuhkan.



III. Penggunaan Cookies dan Statistik Situs



Kami menggunakan sarana untuk meningkatkan pengalaman pengguna Situs dan melacak pengguna Situs, termasuk cookies. Cookies adalah bagian-bagian kecil dari teks yang suatu situs tempatkan pada komputer Anda untuk membantu mengingat informasi mengenai kunjungan Anda. Cookies tidak dpat membaca data yang ada pada perangkat keras Komputer Anda atau mengambil informasi pribadi Anda. Kami menggunakan informasi yang diperoleh dari cookies untuk meningkatkan pengalaman penggunaan Anda dan kualitas Layanan kami secara keseluruhan. Cookies kami dapat juga disediakan oleh penyedia Layanan pihak ketiga yang memiliki izin untuk meletakkan sarana cookies pada Situs kami.



Kami mengumpulkan statistik pengunjung untuk mengukur kinerja, keamanan, dan pembelajaran untuk perbaikan Situs. Statistik pengunjung berisi ringkasan lalu lintas ke Situs kami. Contoh data yang Kami peroleh melalui statistik pengunjung adalah number of pageviews (jumlah halaman yang diakses), number of visits (jumlah kunjungan ke Situs), jumlah data yang berpindah, dan lain-lain.



IV. Mengubah atau Menghapus Data Anda



Semua pengguna Situs IBR Payroll dan Aplikasi IBR Payrollku dapat meninjau, memperbaharui atau memperbaiki informasi pribadi yang terdapat pada Situs dan Aplikasi Kami.



Akun IBR Payroll tidak dapat dihapus seketika setelah Masa Layanan Pengguna berakhir atau ketika Pengguna memutuskan mengakhiri penggunaan. Penghapusan akun IBR Payroll secara langsung saat Masa Layanan berakhir tidak dimungkinkan untuk dilakukan demi menjaga agar data tetap aman serta menjaga stabilitas Layanan Kami. Apabila Masa Layanan IBR Payroll berakhir, maka dataakan otomatis tidak dapat diakses oleh pengguna. Data Anda akan dihapus dari database Kami setelah 79 (tujuh puluh sembilan) hari kalender dari berakhirnya Masa Layanan apabila Masa Layanan tidak diperpanjang.



V. Kerahasiaan



Situs website dan aplikasi dilengkapi dengan protokol keamanan data Security Socket Layer (SSL). Kami maupun Anda dapat mengakses data dan informasi pribadi karyawan Anda. Kita bersama harus menjaga dan memastikan untuk menjaga kerahasiaan data, dokumen-dokumen dan/atau informasi-informasi yang tersedia selama penggunaan Layanan ini baik informasi tersebut bersumber dari Anda maupun dari Layanan Kami. Setiap pengungkapan kerahasiaan yang akan dilakukan oleh Kami atau Anda harus mendapat dan mengajukan persetujuan tertulis dari pihak yang mengungkapkan, kecuali diisyaratkan secara lain oleh hukum atau perintah pengadilan.



VI. Pengungkapan Data



Kami tidak akan mengungkapkan, membagikan, menjual dan/atau menggunakan informasi pribadi Anda tanpa persetujuan atau instruksi Anda, kecuali kepada atau untuk keperluan dan kepentingan hukum.



Kami dapat menyimpan dan memiliki hak untuk mengungkapkan informasi atau data mengenai Anda atau pengguna situs oleh Anda tanpa izin Anda terlebih dahulu apabila tindakan tersebut diperlukan untuk:



a. melindungi dan membela hak, kepemilikan, dan keselamatan Kami, afiliasi Kami, para pengguna Situs atau public;



b. menerapkan syarat dan ketentuan yang berlaku dalam penggunaan Situs ini;



c. menanggapi klaim yang menyatakan bahwa terdapat konten yang melanggar hak pihak ketiga lainnya;



d. menanggapi klaim mengenai adanya aktivitas yang baik diduga maupun benar-benar melawan hukum;



e. menanggapi audit atau menyelidiki keluhan atau ancaman keamanan; atau



f. mematuhi hukum dan peraturan perundang-undangan yang berlaku, proses hukum dan/atau perintah pengadilan.



VII. Perubahan Kebijakan Privasi



Kami memiliki hak untuk mengubah, memodifikasi, menambah atau menghapus bagian dari Kebijakan Privasi ini setiap saat. Jika Anda terus menggunakan Situs IBR Payroll dan Aplikasi IBR Payrollku Kami setelah adanya perubahan kebijakan privasi ini, berarti Anda menerima perubahan tersebut.'
        ]);
        DeveloperNote::updateOrCreate([
            'label' => 'Terms of Service',
            'slug' => Str::slug('Terms of Service'),
            'content' => 'Selamat datang di IBR Payroll. Terima kasih telah mengunjungi Situs IBR Payroll. Sebelum mengakses dan/atau menggunakan Layanan yang ada di dalam Situs IBR Payroll, pastikan Anda membaca dengan cermat dan hati-hati Syarat dan Ketentuan Penggunaan IBR Payroll dan Layanan (“Syarat dan Ketentuan”) yang ada di halaman ini.



Dengan mengakses dan/atau menggunakan Layanan yang ada di dalam Situs IBR Payroll dan/atau Aplikasi IBR Payroll, Anda setuju bahwa Anda telah membaca, memahami, menerima dan menyetujui serta terikat secara hukum pada Syarat dan Ketentuan ini dan dokumen-dokumen lain sehubungan dengan itu. Jika Anda tidak menyetujui Syarat dan Ketentuan ini, mohon tidak mengakses Situs IBR Payroll dan menggunakan Layanan IBR Payroll.



Syarat dan Ketentuan dalam dokumen ini menggambarkan dan menetapkan ketentuan yang mengendalikan serta mengatur hubungan hukum antara Penyedia Layanan dan Situs IBR Payroll dan Anda atau User sebagai pengguna IBR Payroll.



Anda harus membaca Syarat dan Ketentuan dengan hati-hati dan tidak harus menerima Syarat dan Ketentuan atau mendaftar, mengakses atau menggunakan Layanan kecuali Anda setuju dengan Syarat dan Ketentuan ini.



I. INFORMASI UMUM



1. IBR Payroll adalah suatu perangkat lunak sebagai layanan (software as a service) penggajian dan sumber daya manusia (human resource and payroll) berbasis cloud untuk membantu operasional badan usaha dalam mengelola sumber daya manusia.



2. Penyedia Layanan adalah:



a. PT Fatiha Sakti sebagai penyedia layanan IBR Payroll untuk User baru dan perpanjangan layanan IBR Payroll serta merupakan pemilik situs www.IBR Payroll.com ("Situs IBR Payroll"); atau



b. PT Pegawe Indonesia Digdaya (pemegang lisensi untuk penjualan dan distribusi layanan) sebagai penyedia layanan untuk User yang masa berlangganan atau masa layanannya dimulai selambat-lambatnya pada tanggal 9 Januari 2022.



3. Situs IBR Payroll adalah platform yang dapat digunakan dan diakses oleh User untuk menggunakan Layanan, yang terdiri dari:



a. Portal Admin yang diperuntukkan bagi Super Admin dan Admin Pendukung untuk mengelola data Karyawan yang terdaftar pada sistem IBR Payroll dan diakses melalui www.user.IBR Payroll.com; dan



b. Portal Personalia yang diperuntukkan bagi karyawan untuk mengakses Data yang berkaitan tentang kepegawaian pada perusahaan.



4. Layanan adalah layanan yang tersedia dalam aplikasi IBR Payroll yang terdiri dari: pengelolaan data karyawan, pencatatan absensi karyawan, pemantauan dan pengelolaan shift dan jadwal kerja, penghitungan penggajian dan Tunjangan Hari Raya karyawan, pengelolaan pengajuan dan izin karyawan, pengelolaan pencatatan dan penghitungan cuti, pencatatan pinjaman karyawan, penghitungan dan pembetulan PPh 21, penghitungan BPJS karyawan, penyediaan portal karyawan, pengelolaan pembukuan gaji dan multiapproval.



5. Hak-hak Akses dalam Layanan IBR Payroll meliputi;



a. Hak Akses sebagai Super Administrator, yaitu hak yang diberikan kepada anggota User untuk memiliki akses penuh terhadap pengelolaan IBR Payroll;



b. Hak Akses sebagai Administrator, yaitu hak yang diberikan kepada anggota User oleh Super Admin untuk memiliki akses penuh terhadap pengelolaan IBR Payroll, namun tidak memiliki kewenangan untuk menunjuk Administrator lainnya;dan



c. Hak Akses sebagai Administrator Pendukung, yaitu hak yang diberikan kepada anggota User oleh Super Admin untuk memiliki akses terhadap fitur IBR Payroll kecuali fitur Karir dan Remunerasi, Penggajian, Gaji dan LTHR, dan BPJS dan tidak memiliki kewenangan untuk menunjuk Administrator lainnya.



6. User atau Anda merupakan pengguna Layanan dan aplikasi IBR Payroll sejauh sesuai dengan konteksnya terdiri dari:



a. Setiap orang yang membuka dan/atau mengakses Situs IBR Payroll;



b. Perusahaan, yaitu merupakan badan usaha yang mendaftarkan badan usahanya pada sistem IBR Payroll; atau



c. Karyawan, yaitu tenaga kerja yang didaftarkan oleh Perusahaan untuk diikutsertakan dalam IBR Payroll.



7. Paket Standard adalah paket yang disediakan oleh IBR Payroll dengan fitur Data Personalia, Catatan Kehadiran, Penggajian & THR, Portal Personalia, Pembukuan Gaji, dan 1 (satu) administrator untuk mengelola penggajian dan non-penggajian sekaligus.



8. Paket Sukses adalah paket yang disediakan oleh IBR Payroll berisikan fitur-fitur Data Personalia, Catatan Kehadiran, Penggajian & THR, Portal Personalia, Pembukuan Gaji, Kelola Sakit & Izin, Kelola Cuti, Kelola Pinjaman, Kelola PPh 21, BPJS Ketenagakerjaan dan Kesehatan, Pengelolaan Pola Kerja dan hak akses sebanyak 3 (tiga) Administrator.



9. Hak Kekayaan Intelektual termasuk namun tidak terbatas pada hak cipta dan merek, baik yang terdaftar maupun tidak.



10. Waktu Kerja adalah hari saat Penyedia Layanan melakukan kegiatan operasionalnya, yaitu Hari Senin hingga Jumat, kecuali libur nasional/publik, pukul 08.00-18.00 WIB.



11. Tagihan adalah dokumen yang menuliskan sejumlah biaya yang harus dibayar oleh Perusahaan untuk penggunaan Layanan yang terdiri dari:



a. Tagihan Layanan Awal adalah tagihan yang harus dibayarkan User pada saat pertama kali mendaftar di IBR Payroll sesuai dengan paket, kuota, dan jangka waktu Layanan yang dipilih oleh User atau 5 (lima) hari sebelum jangka waktu Layanan Percobaan habis sebagai bentuk penawaran kepada User untuk berlangganan IBR Payroll;



b. Tagihan Perpanjangan adalah tagihan yang diberikan selambat-lambatnya pada hari terakhir Layanan digunakan. Apabila User melakukan pembayaran atas Tagihan Perpanjangan, berarti User setuju untuk memperpanjang penggunaan Layanan untuk 1 (satu) bulan berikutnya;



c. Tagihan Naikkan Layanan adalah tagihan yang diberikan Penyedia Layanan dan harus dibayar oleh User apabila User bermaksud meningkatkan paket layanan IBR Payroll, yaitu semula Paket Standard menjadi Paket Sukses sesuai dengan jumlah Kuota Personalia; dan



d. Tagihan Tambah Kuota adalah Tagihan yang diberikan Penyedia Layanan dan harus dibayar oleh User apabila User bermaksud menambah karyawan yang didaftarkan ke dalam aplikasi IBR Payroll. Apabila Perusahaan menambah karyawan di tengah periode (sebelum jatuh tempo) maka tagihan yang dikenakan untuk tambahan kuota tersebut dihitung secara pro rata.



12. Data adalah informasi yang akan diberikan oleh User kepada Penyedia Layanan yang disediakan dalam Situs IBR Payroll dan/atau aplikasi IBR Payroll, dimana kebenaran informasi yang diberikan menjadi tanggung jawab User.



13. Kuota Personalia adalah jumlah maksimal Karyawan yang dapat didaftarkan oleh Perusahaan ke dalam akun IBR Payroll.



II. PERSETUJUAN



1. Anda dengan ini menyatakan dan menjamin bahwa:



a. Anda telah membaca dan menyetujui Syarat dan Ketentuan, Kebijakan Privasi dan Ketentuan Biaya kami;



b. Anda akan menggunakan dan/atau mengakses Situs IBR Payroll, Layanan, Konten Pengguna Kami hanya untuk tujuan yang sah;



c. Tidak ada materi apapun yang disampaikan melalui akun Anda atau yang diunggah atau dibagikan oleh Anda melalui Situs IBR Payroll, Layanan, dan/atau aplikasi pendukung Layanan akan melanggar atau menyalahi hak pihak ketiga manapun, termasuk hak cipta, merek dagang, privasi, publisitas atau hak kepemilikan atau pribadi lainnya; atau mengandung fitnah, pencemaran nama baik atau materi yang melanggar hukum;



d. Semua informasi yang Anda berikan kepada Penyedia Layanan (termasuk namun tidak terbatas pada informasi data pribadi dan kontak) adalah akurat dan lengkap;



e. Penyedia Layanan berhak untuk mengubah, memodifikasi, menunda atau menghentikan semua atau sebagian dari Situs IBR Payroll atau Layanan kapanpun. Penyedia Layanan juga dapat menentukan batas pada fitur-fitur tertentu atau membatasi akses Anda berdasarkan keputusan internal Penyedia Layanan atau peraturan terkait dengan penyelenggaraan IBR Payroll dan Layanan.



f. Penyedia Layanan dari waktu ke waktu, tanpa memberikan alasan atau pemberitahuan apapun sebelumnya, dapat memperbarui, mengubah, meunda, menghentikan dan/atau mengakhiri semua konten pada Situs IBR Payroll, secara keseluruhan atau sebagian, termasuk namun tidak terbatas pada desain, teks, gambar graifs, foto, gambar, citra, video, Aplikasi, musik, suara dan file lain, tarif, biaya, kuotasi, data historis, grafik, statistik, artikel, informasi kontak kami, setiap informasi lain, dan pemilihan serta pengaturannya.



2. Anda dengan ini menyatakan dan menjamin bahwa:



a. Anda bertanggung jawab untuk membuat semua pengaturan yang diperlukan agar Anda memiliki akses ke IBR Payroll. Anda juga bertanggung jawab untuk memastikan bahwa semua orang yang mengakses IBR Payroll melalui koneksi internet Anda mengetahui dan mematuhi Syarat dan Ketentuan ini serta ketentuan lain yang berlaku.



b. Internet dapat mengalami gangguan, pemadaman transmisi, penundaan transmisi karena lalu lintas internet atau transmisi data yang salah sebagaimana hal-hal tersebut melekat pada internet yang bersifat terbuka bagi publik.



III. PENGGUNAAN LAYANAN DAN APLIKASI



Dengan Anda melanjutkan penggunaan atau pengaksesan IBR Payroll, berarti Anda telah menyatakan dan menjamin kepada Penyedia Layanan bahwa:



1. Anda hanya diperkenankan untuk mengakses dan/atau menggunakan IBR Payroll untuk keperluan Perusahaan dan non-komersil, yang berarti bahwa Situs IBR Payroll ini hanya boleh diakses dan digunakan secara langsung oleh Perusahaan yang sedang mencari produk atau Layanan untuk membantu mengelola sumber daya manusia. Akses dan penggunaan Situs IBR Payroll di luar keperluan Perusahaan atau non-komersil dilarang, dan melanggar Syarat dan Ketentuan ini.



2. Anda tidak diperkenankan menggunakan IBR Payroll untuk hal sebagai berikut:



a. untuk menyakiti, menyiksa, mempermalukan, memfitnah, mencemarkan nama baik, mengancam, mengintimidasi atau mengganggu orang atau bisnis lain, atau apapun yang melanggar privasi atau yang Penyedia Layanan anggap penuh kebencian, tidak senonoh, tidak patut, tidak pantas, atau diskriminatif;



b. dengan cara yang melawan hukum, menipu, atau tindakan komersil;



c. melanggar atau menyalahi hak orang lain, termasuk tanpa terkecuali hak paten, merek dagang, hak cipta, rahasia dagang, publisitas, dan hak milik lainnya;



d. membuat, memeriksa, memperbarui, mengubah atau memperbaiki database, rekaman, atau direktori Anda ataupun orang lain;



e. menggunakan kode komputer otomatis, proses atau sistem “screen scraping”, program, robot, net crawler, spider, pemrosesan data, trawling atau kode komputer; dan/atau



f. melanggar Syarat dan Ketentuan, atau ketentuan lainnya yang ada pada IBR Payroll.



3. Penyedia Layanan tidak bertanggung jawab atas kehilangan akibat kegagalan dalam mengakses IBR Payroll atau metode penggunaan IBR Payroll yang di luar kendali kami.



4. Penyedia Layanan tidak bertanggung jawab atau dapat disalahkah atas kehilangan atau kerusakan yang di luar perkiraan saat Anda mengakses atau menggunakan IBR Payroll. Kehilangan termasuk kehilangan penghematan biaya yang diharapkan, kehilangan bisnis atau kesempatan bisnis, kehilangan pemasukan atau keuntungan, atau kehilangan atau kerusakan apapun yang Anda alami akibat penggunaan IBR Payroll.



IV. LAYANAN PERCOBAAN



1. Perusahaan dapat memperoleh uji coba akses penggunaan IBR Payroll bebas biaya (“Layanan Percobaan”) untuk maksimal selama 14 (empat belas) hari kalender. Layanan Percobaan diberikan kepada Perusahaan yang disetujui oleh Penyedia Layanan. Layanan Percobaan ini diberikan dengan maksud untuk membantu Perusahaan mengambil keputusan apakah akan menjadi User berlangganan IBR Payroll.



2. Selambat-lambatnya 2 (dua) hari sebelum jangka waktu Layanan Percobaan berakhir, Penyedia Layanan akan mengirimkan Tagihan Layanan Awal kepada Perusahaan sebagai bentuk penawaran kepada Perusahaan untuk menjadi User berlangganan. Apabila Perusahaan membayar tagihan tersebut, berarti Perusahaan telah setuju untuk menjadi User berlangganan IBR Payroll dan terikat pada Syarat dan Ketentuan ini.



V. JANGKA WAKTU BERLANGGANAN



1. Perusahaan dapat berlangganan IBR Payroll untuk jangka waktu 1 (satu) bulan, 6 (enam) bulan, atau 1 (satu) tahun.



2. Apabila Perusahaan ingin berlangganan IBR Payroll untuk 6 (enam) bulan atau lebih, maka Perusahaan dapat berkomunikasi dengan Penyedia Layanan melalui unit terkait untuk menuangkan kesepakatan berlangganan ke dalam perjanjian penggunaan layanan. Perjanjian penggunaan layanan tersebut secara umum mengacu pada isi dalam Syarat dan Ketentuan ini dengan tidak menutup kemungkinan adanya kesepakatan-kesepakatan lebih spesifik lainnya.



VI. KEWAJIBAN USER



1. Kewajiban Pembayaran Layanan



a. Tagihan untuk Biaya layanan IBR Payroll akan dibuat setiap bulan, dimulai satu bulan dari tanggal User mulai berlangganan IBR Payroll.



b. Perusahaan wajib membayarkan seluruh biaya yang ditagihkan dengan jumlah Karyawan yang didaftarkan pada IBR Payroll dengan ketentuan mengenai biaya yang ada di Situs IBR Payroll melalui bank yang ditunjuk oleh IBR Payroll.



c. Skema pembayaran yang dapat dipilih oleh Perusahaan adalah:



1) pembayaran setiap 1 (satu) bulan;



2) pembayaran setiap 6 (enam) bulan; atau



3) pembayaran untuk 1 (satu) tahun.



4) Untuk skema pembayaran setiap 6 (enam) bulan atau 1 (satu)tahun, User dapat menandatangani perjanjian penggunaan layanan dengan Penyedia Layanan.



2. Kewajiban User untuk menghormati Hak Kekayaan Intelektual IBR Payroll



Semua Hak Kekayaan Intelektual dalam IBR Payroll dimiliki oleh Penyedia Layanan. Semua informasi dan bahan, termasuk namun tidak terbatas pada: Aplikasi, teks, data, grafik, citra, merek dagang, logo, ikon, kode html dan kode lainnya dalam Situs IBR Payroll dan aplikasi IBR Payroll dilarang untuk dipublikasikan, dimodifikasi, disalin, direproduksi, digandakan atau diubah dengan cara apa pun tanpa izin yang dinyatakan secara tertulis oleh Penyedia Layanan. Jika User melanggar hak-hak ini, Penyedia Layanan berhak untuk membuat gugatan perdata untuk jumlah keseluruhan kerusakan atau kerugian yang diderita. Pelanggaran-pelanggaran ini juga bisa merupakan tindak pidana sebagaimana diatur oleh peraturan perundang-undangan yang berlaku.



3. Ganti Rugi



User setuju untuk mengganti rugi Penyedia Layanan dan petugasnya terhadap semua kerugian, pajak, biaya, biaya hukum, dan kewajiban (yang ada saat ini, di masa yang akan datang, kontingensi, atau apapun yang berbasis ganti rugi), yang diderita oleh Penyedia Layanan sebagai hasil atau hubungan dari pelanggaran Syarat dan Ketentuan ini atau dokumen terkait lainnya yang dilakukan oleh User dan/atau langkah-langkah yang dilakukan oleh Penyedia Layanan ketika terjadi pelanggaran Syarat dan Ketentuan ini atau dokumen terkait lainnya.



 VII. PENGHENTIAN LAYANAN



1. Penyedia Layanan dapat menghentikan pemberian Layanan dan akses IBR Payroll kepada User atau mengakhiri perjanjian penggunaan layanan dengan User dengan alasan antara lain sebagai berikut:



a. User tidak melakukan pembayaran Tagihan Perpanjangan;



b. User melanggar sebagian atau seluruh isi Syarat dan Ketentuan ini; dan/atau



c. User melanggar sebagian atau seluruh dokumen yang berlaku lainnya.



2. User dapat menghentikan penggunaan Layanan dan aplikasi IBR Payroll dengan membuat surat penghentian Layanan yang ditujukan kepada IBR Payroll pada alamat:



Gedung Binasentra Lantai. 1 Unit 106



Kompleks Bidakara



Jl. Gatot Subroto Kav.71-73



Jakarta 12870 – Indonesia



3. Apabila Penyedia Layanan melakukan penghentian Layanan atau penutupan akses IBR Payroll kepada User yang disebabkan User tidak melakukan pembayaran biaya Layanan IBR Payroll sesuai dengan jumlah kuota setelah tagihan pembayaran jatuh tempo, status akun User akan menjadi:



a. Tidak aktif.



Status yang diberikan oleh Penyedia Layanan apabila User tidak membayar tagihan perpanjang layanan IBR Payroll setelah 10 (sepuluh) hingga 79 hari kalender sejak tanggal jatuh tempo. Setelah User tidak membayar lewat dari 10 (sepuluh) hari dari tanggal jatuh tempo, maka User masih dapat mengakses akun User namun tidak dapat menggunakan seluruh fitur yang ada. Namun, apabila di antara 10 (sepuluh) hingga 79 hari tersebut User melakukan pembayaran perpanjangan, User dapat menggunakan fitur kembali.



b. Ditutup.



Status yang diberikan oleh Penyedia Layanan apabila User tidak membayar tagihan perpanjang Layanan IBR Payroll setelah 79 hari kalender sejak tanggal jatuh tempo. Setelah User tidak membayar lewat dari 79 hari dari tanggal jatuh tempo, maka akun User ditutup secara permanen. Apabila User ingin menggunakan Layanan dan aplikasi IBR Payroll maka proses berlangganan IBR Payroll harus dimulai dari awal termasuk migrasi data.



4. Apabila setelah jangka waktu penggunaan IBR Payroll berakhir User masih memiliki dana yang tersimpan pada Akun User, maka dana tersebut akan dikembalikan selambat-lambatnya 10 (sepuluh) hari Kerja setelah tanggal berakhirnya jangka waktu penggunaan IBR Payroll.



5. Apabila User memiliki dana yang tersimpan pada akun User setelah User menghentikan penggunaan IBR Payroll atau User mengakhiri Perjanjian Kerja Sama atau Layanan diberhentikan oleh Penyedia Layanan dengan alasan-alasan di Bagian VII.1, maka User tidak akan memperoleh kembali dana tersebut (no-refund).



VIII. PERJANJIAN TINGKAT LAYANAN



1. Target Ketersediaan Layanan



Penyedia Layanan memberikan jaminan sehubungan dengan server uptime untuk 99,8 % untuk setiap bulan kalender.



2. Pengecualian



Kegagalan sistem tidak menjadi tanggung jawab Penyedia Layanan apabila kegagalan sistem tersebut disebabkan oleh:



a. penggunaan Layanan oleh User dengan cara yang tidak diizinkan dalam Syarat dan Ketentuan atau Perjanjian Kerja Sama yang berlaku;



b. masalah internet umum, kejadian force majeure atau faktor lain di luar kendali Penyedia Layanan;



c. kegagalan atau malfungsi pada peralatan User termasuk namun tidak terbatas pada Aplikasi, koneksi jaringan atau infrastruktur lainnya; atau



d. kegagalan atau malfungsi sistem, tindakan atau kelalaian pihak ketiga; atau pemeliharaan terjadwal atau perawatan darurat yang wajar.



3. User menghubungi Penyedia Layanan untuk memperoleh bantuan penggunaan IBR Payroll hanya melalui layanan chat intercom yang tersedia pada Situs IBR Payroll di Waktu Kerja.



IX. HUBUNGAN DENGAN PIHAK KETIGA



1. Penyedia Layanan tidak akan memberikan Data User kepada pihak ketiga kecuali diwajibkan oleh hukum dan/atau atas perintah peraturan perundang-undangan atau lembaga pemerintah atau peradilan, kecuali atas persetujuan tertulis User.



2. Penyedia Layanan tidak bertanggung jawab atas layanan pihak ketiga yang bermitra dengan IBR Payroll.



3. Seluruh resiko yang terjadi apabila diakibatkan oleh layanan pihak ketiga yang bermitra dengan Penyedia Layanan merupakan tanggung jawab pihak ketiga.



X. TRANSMISI ELEKTRONIK



Syarat dan Ketentuan ini, dan setiap amandemennya, dengan cara apa pun yang diterima, harus diperlakukan sebagai kontrak sebagaimana mestinya dan harus dianggap memiliki akibat hukum yang mengikat sama seperti versi asli yang ditandatangani secara langsung.



XI. FORCE MAJEURE



Dalam hal ini apabila Penyedia Layanan tidak dapat melaksanakan kewajiban baik sebagian maupun seluruhnya yang diakibatkan oleh hal-hal diluar kekuasaan atau kemampuan IBR Payroll, termasuk namun tidak terbatas pada bencana alam, perang, huru-hara, adanya kebijakan/peraturan pemerintah yang tidak memperbolehkan atau yang membatasi IBR Payroll untuk beroperasi dibawah jurisdiksi hukum Indonesia, serta kejadian-kejadian atau peristiwa-peristiwa diluar kekuasaan atau kemampuan Penyedia Layanan, maka dengan ini User membebaskan Penyedia Layanan dari segala macam tuntutan dalam bentuk apapun terkait dengan tidak dapat dilaksanakannya kewajiban oleh Penyedia Layanan.



XII. PENYELESAIAN SENGKETA



1. Dalam hal terjadi sengketa atau perselisihan yang timbul dari atau sehubungan dengan Syarat dan Ketentuan ini, Penyedia Layanan dan Perusahaan melakukan pembahasan dengan itikad baik untuk mencapai penyelesaian berdasarkan kesepakatan bersama dalam waktu 30 (tiga puluh) Hari Kerja sejak tanggal pemberitahuan perselisihan. Namun, jika perselisihan tersebut tidak dapat diselesaikan melalui musyawarah dalam waktu 30 (tiga puluh) Hari Kerja, maka sengketa atau perselisihan tersebut akan diselesaikan melalui Pengadilan Negeri Jakarta Selatan.



2. Syarat dan Ketentuan ini menggunakan hukum atau jurisdiksi negara Republik Indonesia.



XIII. KETENTUAN LAIN-LAIN



1. Disclaimer



a. IBR Payroll tidak bertanggung jawab terhadap segala macam bentuk kelalaian yang dilakukan oleh User.



b. Dengan menggunakan Layanan IBR Payroll, User secara otomatis mengikuti sistem yang terdapat pada fitur-fitur IBR Payroll.



c. User bertanggung jawab untuk memastikan kebenaran, keabsahan dan kejelasan dokumen-dokumen untuk pendaftaran IBR Payroll, dan dengan ini User membebaskan IBR Payroll dari segala gugatan, tuntutan dan/atau ganti rugi dari pihak manapun sehubungan dengan ketidakbenaran informasi, Data, keterangan, kewenangan dan atau kuasa yang diberikan oleh User.



2. Perubahan



Dengan memberikan pemberitahuan sebelumnya kepada User, sesuai dengan ketentuan yang berlaku, User dengan ini setuju bahwa setiap saat IBR Payroll berhak mengubah, yang termasuk namun tidak terbatas pada memperbaiki, menambah atau mengurangi, ketentuan dalam Syarat dan Ketentuan, dan User terikat pada seluruh perubahan yang dilakukan oleh IBR Payroll.



3. Komunikasi



User dapat menghubungi Penyedia Layanan melalui:



a. Email          : team@IBR Payroll.com



b. Telepon         : (021) 3115-1775



c. Kantor IBR Payroll



Gedung Binasentra Lantai. 1 Unit 106

Kompleks Bidakara

Jl. Gatot Subroto Kav.71-73

Jakarta 12870 – Indonesia



XIV. DOKUMEN YANG BERLAKU



1. Sebagai tambahan dan pelengkap Syarat dan Ketentuan ini, dokumen-dokumen berikut juga berlaku terhadap penggunaan Layanan dan aplikasi IBR Payroll oleh User;



a. Kebijakan Privasi, yang menetapkan ketentuan-ketentuan yang berlaku ketika Penyedia Layanan mengolah setiap Data yang dikumpulkan dari User, atau yang User berikan kepada Penyedia Layanan. Dengan menggunakan IBR Payroll, Anda setuju dengan pengumpulan, penggunaan, pengungkapan Data Anda dan Anda menjamin bahwa semua Data yang Anda berikat adalah akurat;



b. Perjanjian penggunaan layanan, yang berlaku untuk User yang berlangganan Layanan dan aplikasi IBR Payroll untuk jangka waktu di atas 6 (enam) bulan;



c. Perjanjian Pengguna Akhir (apabila relevan).



2. Jika terdapat pertentangan antara Syarat dan Ketentuan ini dengan Perjanjian Kerja Sama, maka ketentuan yang ada dalam Syarat dan Ketentuan ini yang berlaku.



Dengan menggunakan IBR Payroll, Anda mengakui bahwa Anda telah membaca, memahami, dan menyetujui Syarat dan Ketentuan ini.'
        ]);
    }
}

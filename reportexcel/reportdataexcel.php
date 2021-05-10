<?php
// include file koneksi.php
include('koneksi.php');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// membuat heading dari tabel dengan kolom No, Nama, Kelas, Alamat dan ditampilkan di cell A1,B1,C1,D1
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Kelas');
$sheet->setCellValue('D1', 'Alamat');

// query untuk mengambil data pada tabel tb_siswa
$query = mysqli_query($koneksi,"select * from tb_siswa");
// variabel i untuk menyimpan nomor awal cell, bernilai 2 nantinya data ditampilkan mulai dari baris 2
$i = 2;
// variabel nomor untuk memberi urutan nomor, dimulaidari 1
$no = 1;
// setiap perulangan, data disimpan pada variabel row
while($row = mysqli_fetch_array($query))
{
    // menampilkan data dari hasil query, ditampilkan secara berurutaan
    // kolom A untuk nomor
	$sheet->setCellValue('A'.$i, $no++);
    //kolom B untuk nama
	$sheet->setCellValue('B'.$i, $row['nama']);
    //kolom C untuk kelas
	$sheet->setCellValue('C'.$i, $row['kelas']);
    //kolom D untuk alamat
	$sheet->setCellValue('D'.$i, $row['alamat']);	
	$i++;
}

$styleArray = [
            // mengatur border untuk cell
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i = $i - 1;
// border digunakan dari Cell A1 hingga kolom D dengan baris diakhir perulangan data
$sheet->getStyle('A1:D'.$i)->applyFromArray($styleArray);

// membuat report dalam bentuk xlsx
$writer = new Xlsx($spreadsheet);
// nama file excel yang akan disimpan
$writer->save('Report Data Siswa.xlsx');
?>
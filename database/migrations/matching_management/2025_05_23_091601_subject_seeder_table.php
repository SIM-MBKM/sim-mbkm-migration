<?php

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  protected $dbConn = 'matching_management';
  protected $table = 'subjects';

  private function getSubjectsData()
  {
    return [
      [
        'mata_kuliah' => 'Kalkulus 1',
        'kode' => 'SM234101',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib'
      ],
      [
        'mata_kuliah' => 'Fisika Mekanika',
        'kode' => 'SF234102',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 4,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Geologi Fisik',
        'kode' => 'CF234101',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Perpetaan',
        'kode' => 'CF234102',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Pengantar Ilmu Kebumian',
        'kode' => 'CF234103',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Komputasi Geofisika',
        'kode' => 'CF234104',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3, 
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Kalkulus 2',
        'kode' => 'SM234201',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'mata_kuliah' => 'Fisika Listrik dan Magnet',
        'kode' => 'SF234202',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 4,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Kimia',
        'kode' => 'SK234102',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Petrologi',
        'kode' => 'CF234205',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Elektronika Dasar',
        'kode' => 'CF234206',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Pemodelan Data Geofisika',
        'kode' => 'CF234207',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Geodinamika',
        'kode' => 'CF234308',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Geologi Struktur',
        'kode' => 'CF234309',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Fisika Batuan',
        'kode' => 'CF234310',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 4,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Geofisika Matematika',
        'kode' => 'CF234311',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3, 
        'kelas' => 'Matematika dan Ilmu Pengetahuan Alam',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Seismologi',
        'kode' => 'CF234312',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Seismik',
        'kode' => 'CF234313',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Gaya Berat dan Magnetik',
        'kode' => 'CF234314',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Prinsip Stratigrafi',
        'kode' => 'CF234415',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Analisis Data Digital Geofisika',
        'kode' => 'CF234416',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'mata_kuliah' => 'Analisis Data Well Log',
        'kode' => 'CF234417',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Geoteknik',
        'kode' => 'CF234418',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Geolistrik',
        'kode' => 'CF234419',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Elektromagnetik',
        'kode' => 'CF234420',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Islam',
        'kode' => 'UG234901',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Kristen',
        'kode' => 'UG234902',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Katolik',
        'kode' => 'UG234903',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Hindu',
        'kode' => 'UG234904',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Buddha',
        'kode' => 'UG234905',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Agama Konghucu',
        'kode' => 'UG234906',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Pancasila',
        'kode' => 'UG234911',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Kewirausahaan Berbasis Teknologi',
        'kode' => 'UG234915',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Mitigasi Bencana Geologi',
        'kode' => 'CF234621',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Kewarganegaraan',
        'kode' => 'UG234913',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Bahasa Inggris',
        'kode' => 'UG234914',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Aplikasi Teknologi dan Transformasi Digital',
        'kode' => 'UG234916',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Seminar',
        'kode' => 'CF234722',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Kuliah Lapangan Terpadu',
        'kode' => 'CF234723',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 4,
        'kelas' => 'Desain Teknik dan eksperimen berbasis masalah',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      [
        'mata_kuliah' => 'Tugas Akhir',
        'kode' => 'CF234824',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 4,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Wajib',
      ],
      // MATA KULIAH PILIHAN
      [
        'mata_kuliah' => 'Kapita Selekta 1',
        'kode' => 'CF234325',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Elektronika Digital',
        'kode' => 'CF234426',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Mekanika Batuan',
        'kode' => 'CF234427',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geologi Minyak dan Gas Bumi',
        'kode' => 'CF234428',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Petromagnetik',
        'kode' => 'CF234429',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Termodinamika',
        'kode' => 'CF234443',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geostatistika',
        'kode' => 'CF234444',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Sistem Informasi Geografis',
        'kode' => 'CF234445',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Vulkanologi',
        'kode' => 'CF234546',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Interpretasi Data Seismik',
        'kode' => 'CF234530',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Seismik Pasif',
        'kode' => 'CF234531',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Instrumentasi Geofisika',
        'kode' => 'CF234532',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Rekayasa Kegempaan',
        'kode' => 'CF234533',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 3,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geofisika Kelautan',
        'kode' => 'CF234534',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Wawasan Geofisika Global',
        'kode' => 'CF234535',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Pendidikan Umum',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Kerja Praktik',
        'kode' => 'CF234536',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 0,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Manajemen Eksplorasi',
        'kode' => 'CF234547',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Kapita Selekta 2',
        'kode' => 'CF234548',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Mineral dan Batubara',
        'kode' => 'CF234549',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Teknologi Informasi dan Komunikasi',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geowisata',
        'kode' => 'CF234550',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Akuisisi dan Pengolahan Data Seismik',
        'kode' => 'CF234637',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geofisika Reservoir',
        'kode' => 'CF234638',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Elektromagnetik Pasif',
        'kode' => 'CF234639',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Hidrogeologi',
        'kode' => 'CF234651',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Kuliah Lapangan Terpadu 1',
        'kode' => 'CF234652',
        'semester' => 'GENAP',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Geotermal',
        'kode' => 'CF234740',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geotomografi',
        'kode' => 'CF234741',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Teknik Geotermal',
        'kode' => 'CF234742',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Eksplorasi Air Tanah',
        'kode' => 'CF234753',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geofisika Bencana',
        'kode' => 'CF234754',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geofisika Arkeologi',
        'kode' => 'CF234755',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Geofisika Pertanian',
        'kode' => 'CF234756',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 2,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
      [
        'mata_kuliah' => 'Magang',
        'kode' => 'CF234757',
        'semester' => 'GANJIL',
        'prodi_penyelenggara' => 'Teknik Geofisika',
        'sks' => 9,
        'kelas' => 'Ilmu dan Teknologi Rekayasa',
        'departemen' => 'Teknik Geofisika',
        'tipe_mata_kuliah' => 'Pilihan',
      ],
    ];
  }

  public function up()
  {
    // seed subjects
    $now = Carbon::now();
    $this->seedSubjects($now);
  }

  public function down()
  {
    // truncate all tables
    DB::connection($this->dbConn)->table($this->table)->truncate();

    // delete all data
    DB::connection($this->dbConn)->table($this->table)->delete();
  }

  private function seedSubjects(Carbon $now)
  {
    foreach ($this->getSubjectsData() as $subject) {
      DB::connection($this->dbConn)->table($this->table)->insert([
        'id' => Uuid::uuid4()->toString(),
        'mata_kuliah' => $subject['mata_kuliah'],
        'kode' => $subject['kode'],
        'semester' => $subject['semester'],
        'prodi_penyelenggara' => $subject['prodi_penyelenggara'],
        'sks' => $subject['sks'],
        'kelas' => $subject['kelas'],
        'departemen' => $subject['departemen'],
        'tipe_mata_kuliah' => $subject['tipe_mata_kuliah'],
        'created_at' => $now,
        'updated_at' => $now,
        'deleted_at' => null
      ]);
    }
  }
};
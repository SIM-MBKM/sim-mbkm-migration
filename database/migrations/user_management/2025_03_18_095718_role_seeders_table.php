<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'roles';

  public function up()
  {
    $roles = [
      [
        'id' => '2360bd15-b7b0-4a92-8b3d-bfc68ee30ea2',
        'name' => 'MAHASISWA',
        'description' => 'College Student role, as partaker of events',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => '8bb92c8a-964f-4835-8f8c-a40caa0769cb',
        'name' => 'DOSEN PEMBIMBING',
        'description' => 'Student supervisor, accepting or rejecting student applications',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => '007b02aa-cf0c-403f-9f41-fcc2f3242051',
        'name' => 'MITRA',
        'description' => 'Student external supervisor from the event, keeping check partaker\'s event journey',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => '2c3a02ef-fca4-414f-b5b5-6aeb7bc563c7',
        'name' => 'DOSEN PEMONEV',
        'description' => 'Grader for post-event evaluations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 'fb9f25a7-18c0-4ac8-bcb4-683eeb1797ca',
        'name' => 'LO-MBKM',
        'description' => 'Liaison officer that manages sub-events specific',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => '2c62310a-1865-4f0c-a390-1cefb7a99f1a',
        'name' => 'ADMIN',
        'description' => 'Administrator that manages undergoing systems',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::connection($this->dbConn)->table($this->table)->insert($roles);
  }

  public function down()
  {
    DB::connection($this->dbConn)
      ->table($this->table)
      ->whereIn('name', [
        'MAHASISWA',
        'DOSEN PEMBIMBING',
        'MITRA',
        'DOSEN PEMBIMBING',
        'LO-MBKM',
        'ADMIN',
      ])
      ->delete();
  }
};

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
        'id' => Str::uuid(),
        'name' => 'MAHASISWA',
        'description' => 'College Student role, as partaker of events',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'DOSEN PEMBIMBING',
        'description' => 'Student supervisor, accepting or rejecting student applications',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'MITRA',
        'description' => 'Student external supervisor from the event, keeping check partaker\'s event journey',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'DOSEN PEMONEV',
        'description' => 'Grader for post-event evaluations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'name' => 'LO-MBKM',
        'description' => 'Liaison officer that manages sub-events specific',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
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

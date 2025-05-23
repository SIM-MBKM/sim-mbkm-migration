<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'users';

  private $datas = [
    [
      'id' => '1a4e6ddc-f63e-4317-9788-bcbf671e443a',
      'name' => 'Ir. Eki Komara, S.T., M.T.',
      'nrp' => '198711232020121010',
      'email' => 'komara@its.ac.id'
    ],
    [
      'id' => 'db71c355-3f63-4258-8762-6b9c6cc13106',
      'name' => 'Dr. Ir. Widya Utama, DEA, IPU, ASEAN Eng.',
      'nrp' => '19611024 198803 1 001',
      'email' => 'widya@geofisika.its.ac.id'
    ],
    [
      'id' => 'ba3d1297-0bb2-47dc-b3fb-063195f163a3',
      'name' => 'Dr. Ir. Dwa Desa Warnana, S.Si, M.Si',
      'nrp' => '19760123 200003 1 001',
      'email' => 'dwa_desa@geofisika.its.ac.id'
    ],
    [
      'id' => 'e9e23c6e-4ae8-4a47-9f9e-f5888a716ecb',
      'name' => 'Ir. Wien Lestari, S.T., M.T.',
      'nrp' => '19811002 201212 2 003',
      'email' => 'wien@geofisika.its.ac.id'
    ],
    [
      'id' => 'b020f0bb-8b35-4f92-8360-8697d2d5686c',
      'name' => 'Ir. Firman Syaifuddin, S.Si, M.T.',
      'nrp' => '19840911 201404 1 001',
      'email' => 'firman@geofisika.its.ac.id'
    ],
    [
      'id' => '98acdd86-e507-4721-aecc-b65c132c251a',
      'name' => 'Ir. Mariyanto, S.Si., M.T.',
      'nrp' => '1991201711044',
      'email' => 'mariyanto@geofisika.its.ac.id'
    ],
    [
      'id' => '4ec71cb9-a82f-4c87-a2d8-f272ceae5d77',
      'name' => 'Ir. Nita Ariyanti, S.T., M.Eng.',
      'nrp' => '1986 2020 72087',
      'email' => 'nita.ariyanti@geofisika.its.ac.id'
    ],
    [
      'id' => 'e84b346a-abbb-4cb8-a915-d6f8391f9a0f',
      'name' => 'Kadek Hendrawan Palgunadi, S.T., M.Sc., Ph.D.',
      'nrp' => '1993202411003',
      'email' => 'kadek.palgunadi@its.ac.id'
    ],
    [
      'id' => '5613debb-be62-4149-9cf6-4ec9cff9e70d',
      'name' => 'Dr. Maryadi, S.Si., M.Eng.',
      'nrp' => '19910422 202406 1 001',
      'email' => 'maryadi@its.ac.id'
    ],
    [
      'id' => 'f07f4cf4-2c9f-4b95-9ac6-71baf36483d8',
      "name" => 'Dr. Ir. Ayi Syaeful Bahri, S.Si, MT',
      'nrp' => '19690906 199702 1 001',
      'email' => 'syaeful_b@geofisika.its.ac.id'
    ],
    [
      'id' => '01208a4e-64b9-4420-af1e-989cb66f6aa8',
      'name' => 'Dr. Ir. Amien Widodo, M.Si.',
      'nrp' => '19591010 198803 1 002',
      'email' => 'amienwidodo@geofisika.its.ac.id'
    ],
    [
      'id' => '4c545f6f-e7bc-4632-a7c9-8b3c6d128bf3',
      'name' => 'Ir. Anik Hilyah, S.Si, MT',
      'nrp' => '19790813 200812 2 002',
      'email' => 'anik@geofisika.its.ac.id'
    ],
    [
      'id' => '14dd0984-54f9-4fda-bdb9-f3ea9f7ed868',
      'name' => 'Ir. Moh. Singgih Purwanto, S.Si., M.T.',
      'nrp' => '198009162009121002',
      'email' => 'singgih@geofisika.its.ac.id'
    ],
    [
      'id' => '7b5ff8ec-151f-48ec-9cba-980e4a7d17f4',
      'name' => 'Ir. Juan Pandu Gya Nur Rochman., S.Si., M.T.',
      'nrp' => '19890612 201504 1 003',
      'email' => 'juan@geofisika.its.ac.id'
    ],
    [
      'id' => '51e810e5-9f3c-4b8b-9a5c-b228de9e8820',
      'name' => 'Dr. Ir. M Haris Miftakhul Fajar, S.T., M. Eng.',
      'nrp' => '198902082018031001',
      'email' => 'mharismf@geofisika.its.ac.id'
    ],
    [
      'id' => '755c03bd-5179-4971-8684-1785a3c2ca06',
      'name' => 'Dr. Agnis Triahadini, S.Si., M.Sc.',
      'nrp' => '19921213 202406 2 001',
      'email' => 'agnist@its.ac.id'
    ],
    [
      'id' => 'ac3426ea-3eed-4b22-825d-5b7b79a92603',
      'name' => 'Dharma Arung Laby, S.Si., M.T.',
      'nrp' => '19910422 202406 1 0001',
      'email' => 'dharma.arunglaby@its.ac.id'
    ],
    [
      'id' => '22b42e04-9346-4682-bb21-7c820e5833f0',
      'name' => 'Alutsyah Luthfian S.Si., M.Sc.',
      'nrp' => '1993 2025 11006',
      'email' => 'alutsyah.luthfian@its.ac.id'
    ]
  ];

  public function up()
  {
    // seed $datas
    foreach ($this->datas as $data) {
      \DB::connection($this->dbConn)->table($this->table)->updateOrInsert(
        ['id' => $data['id']], // Check by ID
        [
          'id' => $data['id'],
          'auth_user_id' => $data['id'], // Using same ID as auth_user_id for now
          'role_id' => "8bb92c8a-964f-4835-8f8c-a40caa0769cb", // Default role_id - needs to be set properly
          'nrp' => $data['nrp'],
          'email' => $data['email'],
          'created_at' => now(),
          'updated_at' => now(),
          'last_synced_at' => now(),
          'needs_sync' => false
        ]
      );
    }
  }

  public function down()
  {
    // truncate table
    \DB::connection($this->dbConn)->table($this->table)->truncate();
  }
};
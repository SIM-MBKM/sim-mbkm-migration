<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
  protected $dbConn = 'activity_management';

  // Program Types data
  protected $programTypes = [
    [
      'id' => 'cfe13726-0bae-40a8-8e0c-2cdd33ffeaa8',
      'name' => 'Magang/ Kerja Praktik',
    ],
    [
      'id' => 'fa3164c1-ab15-4341-9688-494afdcef7db',
      'name' => 'Membangun Desa/Kuliah Kerja Nyata Tematik',
    ],
    [
      'id' => '8689aa1d-7ec2-496b-944d-8f6075c644e4',
      'name' => 'Pertukaran Pelajar'
    ],
    [
      'id' => 'e25c27dd-f5d5-4677-b21d-a7c4476082a6',
      'name' => 'Proyek Penelitian'
    ],
    [
      'id' => '37d44f43-4638-464a-ba3a-4ad32c620178',
      'name' => 'Penelitian/Riset'
    ],
    [
      'id' => 'e980a9f1-181f-496b-a55a-dca46ceb097b',
      'name' => 'Kegiatan Wirausaha'
    ],
    [
      'id' => '20e4f027-96ac-42da-a174-a8f648b88281',
      'name' => 'Studi/Proyek Independen'
    ],
    [
      'id' => '0bfcd98c-d8bf-442e-8abc-fd0e6244ec66',
      'name' => 'Asistensi Mengajar di Satuan Pendidikan'
    ]
  ];

  // Levels data
  protected $levels = [
    [
      'id' => '58dabaff-c9a2-4942-923d-202bd285c168',
      'name' => 'Nasional',
      'description' => 'Program tingkat nasional'
    ],
    [
      'id' => '32914c58-0e51-4993-8de7-2824497e42c6',
      'name' => 'Regional',
      'description' => 'Level Regional'
    ],
    [
      'id' => '4c0969bb-ae16-4fbb-91af-3a8fdd985730',
      'name' => 'Internasional',
      'description' => 'Program tingkat internasional'
    ],
    [
      'id' => '50678536-d8b3-423d-8f08-4487605d738f',
      'name' => 'Lokal',
      'description' => 'Program tingkat lokal'
    ]
  ];

  // Groups data
  protected $groups = [
    [
      'id' => 'f4c2d6fa-0095-4b06-a9d5-49d5c3cd3a4d',
      'name' => 'Kementrian',
      'description' => 'Program dari kementrian'
    ],
    [
      'id' => 'cd6a8f90-e487-4bb9-9ee3-36749752eec2',
      'name' => 'ITS',
      'description' => 'updated'
    ],
    [
      'id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
      'name' => 'Industri',
      'description' => 'Program dari sektor industri'
    ],
    [
      'id' => 'a738fe8f-45b1-4bfa-8fd8-c7728a356ccc',
      'name' => 'NGO',
      'description' => 'Program dari organisasi non-pemerintah'
    ]
  ];


  public function up()
  {
    $now = Carbon::now();

    // Seed program_types table
    $this->seedProgramTypes($now);

    // Seed levels table
    $this->seedLevels($now);

    // Seed groups table
    $this->seedGroups($now);

    // Seed activities table
    // $this->seedActivities($now);
  }

  public function down()
  {
    // drop foreing key first
    Schema::connection($this->dbConn)->table('activities', function(Blueprint $table) {
      $table->dropForeign(['program_type_id']);
      $table->dropForeign(['group_id']);
      $table->dropForeign(['level_id']);
    });

    // truncate all tables
    DB::connection($this->dbConn)->table('activities')->truncate();
    DB::connection($this->dbConn)->table('program_types')->truncate();
    DB::connection($this->dbConn)->table('levels')->truncate();
    DB::connection($this->dbConn)->table('groups')->truncate();

    // Clear the tables
    DB::connection($this->dbConn)->table('activities')->delete();
    DB::connection($this->dbConn)->table('program_types')->delete();
    DB::connection($this->dbConn)->table('levels')->delete();
    DB::connection($this->dbConn)->table('groups')->delete();
  }

  /**
   * Seed program_types table
   *
   * @param Carbon $now
   * @return void
   */
  private function seedProgramTypes(Carbon $now)
  {
    $programTypesData = [];

    foreach ($this->programTypes as $type) {
      $programTypesData[] = [
        'id' => isset($type['id']) ? $type['id'] : Str::uuid()->toString(),
        'name' => $type['name'],
        // 'rules' => $type['rules'],
        // 'min_semester' => $type['min_semester'],
        'created_at' => $now,
        'updated_at' => $now,
      ];
    }

    DB::connection($this->dbConn)->table('program_types')->insert($programTypesData);
  }

  /**
   * Seed levels table
   *
   * @param Carbon $now
   * @return void
   */
  private function seedLevels(Carbon $now)
  {
    $levelsData = [];

    foreach ($this->levels as $level) {
      $levelsData[] = [
        'id' => isset($level['id']) ? $level['id'] : Str::uuid()->toString(),
        'name' => $level['name'],
        'description' => $level['description'],
        'created_at' => $now,
        'updated_at' => $now,
      ];
    }

    DB::connection($this->dbConn)->table('levels')->insert($levelsData);
  }

  /**
   * Seed groups table
   *
   * @param Carbon $now
   * @return void
   */
  private function seedGroups(Carbon $now)
  {
    $groupsData = [];

    foreach ($this->groups as $group) {
      $groupsData[] = [
        'id' => isset($group['id']) ? $group['id'] : Str::uuid()->toString(),
        'name' => $group['name'],
        'description' => $group['description'],
        'created_at' => $now,
        'updated_at' => $now,
      ];
    }

    DB::connection($this->dbConn)->table('groups')->insert($groupsData);
  }

  /**
   * Seed activities table
   *
   * @param Carbon $now
   * @return void
   */
  private function seedActivities(Carbon $now)
  {
    $activitiesData = [];

    // Use the main user from auth_service (Muhammad Rafif Tri Risqullah)
    $mainUserId = '22af29d8-1e05-4d2b-b237-70955e0af315'; // ID from auth_service seeder

    // First activity matching the example response
    $activitiesData[] = [
      'id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
      'name' => 'Learning and Development Intern Terbaru',
      'program_type_id' => 'cfe13726-0bae-40a8-8e0c-2cdd33ffeaa8', // Magang/Kerja Praktik
      'level_id' => 'f9618b56-3892-4288-85e4-38b60574ff93', // Nasional
      'group_id' => 'aea7e24d-892f-4a2c-a6c9-d875d31f53d0', // Kementrian
      'description' => '',
      'start_period' => '2025-03-01 07:00:00',
      'months_duration' => 5,
      'activity_type' => 'WFO',
      'location' => 'Kota Jakarta Selatan',
      'web_portal' => '',
      'academic_year' => '2024/2025',
      'program_provider' => 'Perusahaan A',
      'approval_status' => 'APPROVED',
      'submitted_by' => $mainUserId,
      'submitted_user_role' => 'admin',
      'created_at' => $now,
      'updated_at' => $now,
    ];

    // Get IDs for reference tables for the rest of the activities
    $programTypeIds = DB::connection($this->dbConn)->table('program_types')
      ->pluck('id', 'name')
      ->toArray();

    $levelIds = DB::connection($this->dbConn)->table('levels')
      ->pluck('id', 'name')
      ->toArray();

    $groupIds = DB::connection($this->dbConn)->table('groups')
      ->pluck('id', 'name')
      ->toArray();

    // Skip the first activity since we already added it manually
    for ($i = 1; $i < count($this->activities); $i++) {
      $activity = $this->activities[$i];
      $activitiesData[] = [
        'id' => Str::uuid()->toString(),
        'name' => $activity['name'],
        'program_type_id' => $programTypeIds[$activity['program_type']] ?? null,
        'level_id' => $levelIds[$activity['level']] ?? null,
        'group_id' => $groupIds[$activity['group']] ?? null,
        'description' => $activity['description'],
        'start_period' => $activity['start_period'],
        'months_duration' => $activity['months_duration'],
        'activity_type' => $activity['activity_type'],
        'location' => $activity['location'],
        'web_portal' => $activity['web_portal'],
        'academic_year' => $activity['academic_year'],
        'program_provider' => $activity['program_provider'],
        'approval_status' => $activity['approval_status'],
        'submitted_by' => $mainUserId,
        'submitted_user_role' => $activity['submitted_user_role'],
        'created_at' => $now,
        'updated_at' => $now,
      ];
    }

    DB::connection($this->dbConn)->table('activities')->insert($activitiesData);
  }
};

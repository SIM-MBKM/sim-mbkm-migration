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
      'id' => '96d1e3a6-27f3-4842-a6e3-2398ad2ae35e',
      'name' => 'Studi Independen',
      'rules' => 'Minimal semester 6',
      'min_semester' => 6
    ],
    [
      'name' => 'Magang',
      'rules' => 'Minimal semester 5',
      'min_semester' => 5
    ],
    [
      'id' => '3375ff8a-acb6-41ff-bc8c-bdd68f172b7d',
      'name' => 'IISMA',
      'rules' => 'Minimal semester 5, IPK minimal 3.0',
      'min_semester' => 5
    ],
    [
      'name' => 'Pertukaran Pelajar',
      'rules' => 'Minimal semester 4',
      'min_semester' => 4
    ]
  ];

  // Levels data
  protected $levels = [
    [
      'id' => 'f9618b56-3892-4288-85e4-38b60574ff93',
      'name' => 'Nasional',
      'description' => 'Program tingkat nasional'
    ],
    [
      'id' => '8f212374-1aae-488b-a5a9-7fb518a0e47e',
      'name' => 'Regional',
      'description' => 'Level Regional'
    ],
    [
      'name' => 'Internasional',
      'description' => 'Program tingkat internasional'
    ],
    [
      'name' => 'Lokal',
      'description' => 'Program tingkat lokal'
    ]
  ];

  // Groups data
  protected $groups = [
    [
      'id' => 'aea7e24d-892f-4a2c-a6c9-d875d31f53d0',
      'name' => 'Kementrian',
      'description' => 'Program dari kementrian'
    ],
    [
      'id' => '0e6dff59-7b93-40ba-bd73-5c8dcbf5c3fe',
      'name' => 'ITS',
      'description' => 'updated'
    ],
    [
      'name' => 'Industri',
      'description' => 'Program dari sektor industri'
    ],
    [
      'name' => 'NGO',
      'description' => 'Program dari organisasi non-pemerintah'
    ]
  ];

  // Activities data
  protected $activities = [
    [
      'name' => 'Learning and Development Intern Terbaru',
      'description' => '',
      'start_period' => '2025-03-01 07:00:00',
      'months_duration' => 5,
      'activity_type' => 'WFO',
      'location' => 'Kota Jakarta Selatan',
      'web_portal' => '',
      'academic_year' => '2024/2025',
      'program_provider' => 'Perusahaan A',
      'approval_status' => 'APPROVED',
      'submitted_user_role' => 'admin',
      'program_type' => 'IISMA',
      'level' => 'Nasional',
      'group' => 'Kementrian'
    ],
    [
      'name' => 'Full Stack Developer Internship',
      'description' => 'Program magang sebagai Full Stack Developer',
      'start_period' => '2025-02-15 07:00:00',
      'months_duration' => 6,
      'activity_type' => 'WFH',
      'location' => 'Remote',
      'web_portal' => 'https://kampusmerdeka.kemdikbud.go.id',
      'academic_year' => '2024/2025',
      'program_provider' => 'Perusahaan B',
      'approval_status' => 'PENDING',
      'submitted_user_role' => 'admin',
      'program_type' => 'Magang',
      'level' => 'Nasional',
      'group' => 'Industri'
    ],
    [
      'name' => 'IISMA 2025 - University of Tokyo',
      'description' => 'Program IISMA di University of Tokyo',
      'start_period' => '2025-08-01 07:00:00',
      'months_duration' => 6,
      'activity_type' => 'WFO',
      'location' => 'Tokyo, Japan',
      'web_portal' => 'https://iisma.kemdikbud.go.id',
      'academic_year' => '2024/2025',
      'program_provider' => 'Kemdikbud',
      'approval_status' => 'APPROVED',
      'submitted_user_role' => 'admin',
      'program_type' => 'IISMA',
      'level' => 'Internasional',
      'group' => 'Kementrian'
    ],
    [
      'name' => 'Studi Independen - Machine Learning',
      'description' => 'Program studi independen di bidang Machine Learning',
      'start_period' => '2025-02-01 07:00:00',
      'months_duration' => 3,
      'activity_type' => 'Hybrid',
      'location' => 'Kota Surabaya',
      'web_portal' => 'https://kampusmerdeka.kemdikbud.go.id',
      'academic_year' => '2024/2025',
      'program_provider' => 'ITS',
      'approval_status' => 'APPROVED',
      'submitted_user_role' => 'admin',
      'program_type' => 'Studi Independen',
      'level' => 'Nasional',
      'group' => 'ITS'
    ],
    [
      'name' => 'Pertukaran Pelajar - NTU Singapore',
      'description' => 'Program pertukaran pelajar ke NTU Singapore',
      'start_period' => '2025-07-01 07:00:00',
      'months_duration' => 6,
      'activity_type' => 'WFO',
      'location' => 'Singapore',
      'web_portal' => 'https://io.its.ac.id',
      'academic_year' => '2025/2026',
      'program_provider' => 'ITS',
      'approval_status' => 'PENDING',
      'submitted_user_role' => 'admin',
      'program_type' => 'Pertukaran Pelajar',
      'level' => 'Internasional',
      'group' => 'ITS'
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
    $this->seedActivities($now);
  }

  public function down()
  {
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
        'rules' => $type['rules'],
        'min_semester' => $type['min_semester'],
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
      'program_type_id' => '3375ff8a-acb6-41ff-bc8c-bdd68f172b7d', // IISMA
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

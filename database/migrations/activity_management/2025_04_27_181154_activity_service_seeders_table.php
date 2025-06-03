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

  private $activities = [
    [
        'id' => '5abfc89c-0a9d-4071-95cd-7ab0206587ed',
        'name' => 'Analisis Stabilitas Tubuh Bendungan terhadap Gempa: Studi Kasus Bendungan Jlantah',
        'program_type_id' => 'cfe13726-0bae-40a8-8e0c-2cdd33ffeaa8',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => '',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'PT Adhi Karya Persero Tbk',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-05-31 10:24:33',
        'deleted_at' => null,
    ],
    [
        'id' => '06ac73f2-36b1-4dd5-a543-0b7f1971b7ab',
        'name' => 'KARAKTERISASI RESERVOIR MENGGUNAKAN ANALISIS AVO PADA BLOK ROKAN FORMASI PETANI',
        'program_type_id' => 'cfe13726-0bae-40a8-8e0c-2cdd33ffeaa8',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => '',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'PT. Pertamina Hulu Rokan',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-05-31 10:24:33',
        'deleted_at' => null,
    ],
    [
        'id' => 'b27207bf-6f9a-4e6d-ba0d-ed4b22dff49c',
        'name' => '"Mengenal Peradaban Majapahit" Tim Mahasiswa Pertukaran Mahasiswa Merdeka',
        'program_type_id' => '8689aa1d-7ec2-496b-944d-8f6075c644e4',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => '',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'Pertukaran Mahasiswa Merdeka (PMM2) by Kampus Merdeka',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-05-31 10:24:33',
        'deleted_at' => null,
    ],
    [
        'id' => '66826bee-20a7-4a56-a1b1-1fc011fc22e8',
        'name' => 'Applied Data Management, Analysis, Modeling, And Machine Learning For Sustainable Geothermal Energy Development',
        'program_type_id' => '20e4f027-96ac-42da-a174-a8f648b88281',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => '',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'PT. Anugerah Indonesia Lima (AILIMA)',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-05-31 10:24:33',
        'deleted_at' => null,
    ],
    [
        'id' => 'f3057302-6bf4-4559-a2d8-e274164881e2',
        'name' => 'Pemberdayaan Kelompok Sadar Wisata dan Konservasi Sumber Mata Air Desa Bendolo Kabupaten Nganjuk Sebagai Upaya Pengembangan Clean Water and Sanitation',
        'program_type_id' => '37d44f43-4638-464a-ba3a-4ad32c620178',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => '',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'RistekDikti',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-05-31 10:24:33',
        'deleted_at' => null,
    ],
    [
        'id' => '222ed6c1-6c05-4c95-a52e-4753e4063bf5',
        'name' => 'Pengelola dan Analis Lingkungan Hidup',
        'program_type_id' => 'fa3164c1-ab15-4341-9688-494afdcef7db',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '58dabaff-c9a2-4942-923d-202bd285c168',
        'description' => 'Deskripsi baru',
        'start_period' => '2025-03-01 07:00:00',
        'months_duration' => 5,
        'activity_type' => 'WFO',
        'location' => 'Kota Jakarta Selatan',
        'web_portal' => '',
        'academic_year' => '2024/2025',
        'program_provider' => 'Dinas Lingkuhan Hidup (DLH) Kota Surabaya',
        'approval_status' => 'APPROVED',
        'submitted_by' => '22af29d8-1e05-4d2b-b237-70955e0af315',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-05-31 10:24:33',
        'updated_at' => '2025-06-01 12:18:39',
        'deleted_at' => null,
    ],
    // Deleted records (with deleted_at timestamp)
    [
        'id' => '0076165c-a9f3-4a8d-8e8a-fe58d8094f53',
        'name' => 'I Dont Know',
        'program_type_id' => 'e25c27dd-f5d5-4677-b21d-a7c4476082a6',
        'group_id' => 'f4c2d6fa-0095-4b06-a9d5-49d5c3cd3a4d',
        'level_id' => '32914c58-0e51-4993-8de7-2824497e42c6',
        'description' => 'bro i do not know about anything',
        'start_period' => '2025-06-01 04:59:12',
        'months_duration' => 1,
        'activity_type' => 'WFO',
        'location' => 'Surabaya',
        'web_portal' => '',
        'academic_year' => '2025/2026',
        'program_provider' => 'ITS',
        'approval_status' => 'APPROVED',
        'submitted_by' => '58beb504-1b33-430d-8563-eba349abd584',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-06-01 12:06:50',
        'updated_at' => '2025-06-01 12:15:19',
        'deleted_at' => '2025-06-01 12:25:35',
    ],
    [
        'id' => 'cdb954ec-e0be-4f1d-8340-6fa2bb9f5560',
        'name' => 'testing program',
        'program_type_id' => '0bfcd98c-d8bf-442e-8abc-fd0e6244ec66',
        'group_id' => 'f4c2d6fa-0095-4b06-a9d5-49d5c3cd3a4d',
        'level_id' => '32914c58-0e51-4993-8de7-2824497e42c6',
        'description' => 'testing porgram tidak jelas',
        'start_period' => '2025-06-01 05:25:40',
        'months_duration' => 1,
        'activity_type' => 'WFH',
        'location' => 'Surabaya',
        'web_portal' => '',
        'academic_year' => '2025/2026',
        'program_provider' => 'ITS',
        'approval_status' => 'APPROVED',
        'submitted_by' => '58beb504-1b33-430d-8563-eba349abd584',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-06-01 12:38:07',
        'updated_at' => '2025-06-01 12:38:07',
        'deleted_at' => '2025-06-01 12:42:29',
    ],
    [
        'id' => '770dc9ca-d852-4419-a715-a3fa1718dd00',
        'name' => 'Testing baru',
        'program_type_id' => '37d44f43-4638-464a-ba3a-4ad32c620178',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '32914c58-0e51-4993-8de7-2824497e42c6',
        'description' => 'oifwjefoiwejfiaeoijeio',
        'start_period' => '2025-06-01 05:25:40',
        'months_duration' => 1,
        'activity_type' => 'WFO',
        'location' => 'Surabaya',
        'web_portal' => '',
        'academic_year' => '2025/2026',
        'program_provider' => 'ITS',
        'approval_status' => 'APPROVED',
        'submitted_by' => '58beb504-1b33-430d-8563-eba349abd584',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-06-01 12:39:46',
        'updated_at' => '2025-06-01 12:39:46',
        'deleted_at' => '2025-06-01 12:42:33',
    ],
    [
        'id' => '00428b9f-24af-4e38-afe8-9dd9b9eb423b',
        'name' => 'I dont know bro',
        'program_type_id' => '37d44f43-4638-464a-ba3a-4ad32c620178',
        'group_id' => 'f0bdf6ca-a165-46f8-9647-78d200ddeb80',
        'level_id' => '32914c58-0e51-4993-8de7-2824497e42c6',
        'description' => 'i really do not brow',
        'start_period' => '2025-06-01 05:25:40',
        'months_duration' => 1,
        'activity_type' => 'WFO',
        'location' => 'Surabaya',
        'web_portal' => '',
        'academic_year' => '2025/2026',
        'program_provider' => 'ITS',
        'approval_status' => 'APPROVED',
        'submitted_by' => '58beb504-1b33-430d-8563-eba349abd584',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-06-01 12:36:15',
        'updated_at' => '2025-06-01 12:36:15',
        'deleted_at' => '2025-06-01 12:42:38',
    ],
    [
        'id' => 'bc746601-ab55-4b8b-be2a-bf9df599f935',
        'name' => 'I do not now brother',
        'program_type_id' => 'e25c27dd-f5d5-4677-b21d-a7c4476082a6',
        'group_id' => 'f4c2d6fa-0095-4b06-a9d5-49d5c3cd3a4d',
        'level_id' => '32914c58-0e51-4993-8de7-2824497e42c6',
        'description' => 'fjsdlkfjsladkfdfsdfds',
        'start_period' => '2025-06-01 05:25:40',
        'months_duration' => 1,
        'activity_type' => 'WFH',
        'location' => 'Surabaya',
        'web_portal' => '',
        'academic_year' => '2025/2026',
        'program_provider' => 'ITS',
        'approval_status' => 'APPROVED',
        'submitted_by' => '58beb504-1b33-430d-8563-eba349abd584',
        'submitted_user_role' => 'LO-MBKM',
        'created_at' => '2025-06-01 12:36:52',
        'updated_at' => '2025-06-01 12:36:52',
        'deleted_at' => '2025-06-01 12:42:42',
    ],
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

        foreach ($this->activities as $activity) {
            $activitiesData[] = [
                'id' => $activity['id'],
                'name' => $activity['name'],
                'program_type_id' => $activity['program_type_id'],
                'group_id' => $activity['group_id'],
                'level_id' => $activity['level_id'],
                'description' => $activity['description'],
                'start_period' => $activity['start_period'],
                'months_duration' => $activity['months_duration'],
                'activity_type' => $activity['activity_type'],
                'location' => $activity['location'],
                'web_portal' => $activity['web_portal'],
                'academic_year' => $activity['academic_year'],
                'program_provider' => $activity['program_provider'],
                'approval_status' => $activity['approval_status'],
                'submitted_by' => $activity['submitted_by'],
                'submitted_user_role' => $activity['submitted_user_role'],
                'created_at' => Carbon::parse($activity['created_at']),
                'updated_at' => Carbon::parse($activity['updated_at']),
                'deleted_at' => $activity['deleted_at'] ? Carbon::parse($activity['deleted_at']) : null,
            ];
        }

        // Insert all activities at once
        DB::connection($this->dbConn)->table('activities')->insert($activitiesData);
    }
};

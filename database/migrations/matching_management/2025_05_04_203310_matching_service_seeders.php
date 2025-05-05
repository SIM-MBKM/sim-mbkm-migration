<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
    protected $dbConn = 'matching_management';

    public function up()
    {
        $now = Carbon::now();

        // Seed subjects
        $this->seedSubjects($now);

        // Seed documents
        $this->seedDocuments($now);

        // Seed matchings
        $this->seedMatchings($now);

        // Seed equivalents
        $this->seedEquivalents($now);
    }

    private function seedSubjects(Carbon $now)
    {
        $subjects = [
            [
                'id' => '3b057460-bedf-420e-beb2-83f44b490928', // UUID for magang mbkm
                'mata_kuliah' => 'Magang MBKM',
                'kode' => 'MBKM001',
                'semester' => 'GANJIL',
                'prodi_penyelenggara' => 'Informatika',
                'sks' => 6,
                'kelas' => 'A',
                'departemen' => 'Teknologi Informasi',
                'tipe_mata_kuliah' => 'MBKM'
            ],
            [
                'id' => '2497f34b-c159-428f-8b05-bd2ce2d5b149', // UUID for manajemen proyek
                'mata_kuliah' => 'Manajemen Proyek',
                'kode' => 'MBKM002',
                'semester' => 'GANJIL',
                'prodi_penyelenggara' => 'Informatika',
                'sks' => 3,
                'kelas' => 'A',
                'departemen' => 'Teknologi Informasi',
                'tipe_mata_kuliah' => 'MBKM'
            ],
            [
                'id' => '9c3d2f4e-425b-469b-8766-4794f07af5d9', // UUID for komunikasi bisnis
                'mata_kuliah' => 'Komunikasi Bisnis',
                'kode' => 'MBKM003',
                'semester' => 'GANJIL',
                'prodi_penyelenggara' => 'Informatika',
                'sks' => 3,
                'kelas' => 'A',
                'departemen' => 'Teknologi Informasi',
                'tipe_mata_kuliah' => 'MBKM'
            ]
        ];

        foreach ($subjects as $subject) {
            DB::connection($this->dbConn)->table('subjects')->insert([
                'id' => $subject['id'],
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
            ]);
        }
    }

    private function seedDocuments(Carbon $now)
    {
        $subjects = DB::connection($this->dbConn)->table('subjects')->get();

        foreach ($subjects as $subject) {
            DB::connection($this->dbConn)->table('documents')->insert([
                'id' => Str::uuid()->toString(),
                'subject_id' => $subject->id,
                'file_storage_id' => Str::uuid()->toString(),
                'name' => 'Silabus_' . $subject->kode . '.pdf',
                'document_type' => 'SILABUS',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function seedMatchings(Carbon $now)
    {
        $activityId = '10d9bd2a-9f38-4a47-88e9-6868c1bceebc'; // Learning and Development Intern Terbaru

        $matchings = [
            [
                'id' => Str::uuid()->toString(),
                'activity_id' => $activityId,
                'subject_id' => '3b057460-bedf-420e-beb2-83f44b490928',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid()->toString(),
                'activity_id' => $activityId,
                'subject_id' => '2497f34b-c159-428f-8b05-bd2ce2d5b149',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid()->toString(),
                'activity_id' => $activityId,
                'subject_id' => '9c3d2f4e-425b-469b-8766-4794f07af5d9',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::connection($this->dbConn)->table('matchings')->insert($matchings);
    }

    private function seedEquivalents(Carbon $now)
    {
        // Both users (Muhammad Rafif and Muhammad Risqullah) get all three subjects
        $registrationIds = [
            'a1b2c3d4-e5f6-47a8-b9c0-d1e2f3a4b5c6', // Muhammad Rafif
            'b2c3d4e5-f6a7-48b9-c0d1-e2f3a4b5c6d7', // Muhammad Risqullah
        ];

        $subjectIds = [
            '3b057460-bedf-420e-beb2-83f44b490928',
            '2497f34b-c159-428f-8b05-bd2ce2d5b149',
            '9c3d2f4e-425b-469b-8766-4794f07af5d9',
        ];

        $equivalents = [];

        foreach ($registrationIds as $registrationId) {
            foreach ($subjectIds as $subjectId) {
                $equivalents[] = [
                    'id' => Str::uuid()->toString(),
                    'registration_id' => $registrationId,
                    'subject_id' => $subjectId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::connection($this->dbConn)->table('equivalents')->insert($equivalents);
    }

    public function down()
    {
        DB::connection($this->dbConn)->table('equivalents')->delete();
        DB::connection($this->dbConn)->table('matchings')->delete();
        DB::connection($this->dbConn)->table('documents')->delete();
        DB::connection($this->dbConn)->table('subjects')->delete();
    }
};

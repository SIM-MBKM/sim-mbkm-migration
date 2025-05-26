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

        // Seed documents
        $this->seedDocuments($now);

        // Seed matchings
        $this->seedMatchings($now);

        // Seed equivalents
        $this->seedEquivalents($now);
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

        // Get first 3 subjects for matching
        $subjectIds = DB::connection($this->dbConn)->table('subjects')
            ->limit(3)
            ->pluck('id')
            ->toArray();

        $matchings = [];
        foreach ($subjectIds as $subjectId) {
            $matchings[] = [
                'id' => Str::uuid()->toString(),
                'activity_id' => $activityId,
                'subject_id' => $subjectId,
                'status' => 'APPROVED',
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ];
        }

        DB::connection($this->dbConn)->table('matchings')->insert($matchings);
    }

    private function seedEquivalents(Carbon $now)
    {
        // Get all matchings
        $matchings = DB::connection($this->dbConn)->table('matchings')->get();
        
        // Get 3 different subjects for equivalents
        $equivalentSubjectIds = DB::connection($this->dbConn)->table('subjects')
            ->whereNotIn('id', $matchings->pluck('subject_id'))
            ->limit(3)
            ->pluck('id')
            ->toArray();

        $equivalents = [];
        foreach ($matchings as $index => $matching) {
            if (isset($equivalentSubjectIds[$index])) {
                $equivalents[] = [
                    'id' => Str::uuid()->toString(),
                    'matching_id' => $matching->id,
                    'subject_id' => $equivalentSubjectIds[$index],
                    'status' => 'APPROVED',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'deleted_at' => null
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
    protected $dbConn = 'monev_management';

    public function up()
    {
        $now = Carbon::now();

        // Create evaluations for both users
        $this->seedEvaluations($now);

        // Create evaluation scores
        $this->seedEvaluationScores($now);

        // Create partner ratings
        $this->seedPartnerRatings($now);
    }

    private function seedEvaluations(Carbon $now)
    {
        $evaluations = [
            [
                'id' => Str::uuid()->toString(),
                'event_id' => null,
                'mahasiswa_id' => '22af29d8-1e05-4d2b-b237-70955e0af315', // Muhammad Rafif
                'dosen_pemonev_id' => '55c69fa3-c4de-4390-b36c-8343712c08bf', // Dr. Ahmad Fauzi
                'dosen_pembimbing_id' => '6d587477-431e-4de2-b0d6-f48e382c8811', // Dr. Siti Aminah
                'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
                'registration_id' => 'a1b2c3d4-e5f6-47a8-b9c0-d1e2f3a4b5c6',
                'notes' => 'Evaluation for Muhammad Rafif',
                'status' => 'completed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid()->toString(),
                'event_id' => null,
                'mahasiswa_id' => '70c7739f-7812-4386-9665-b00af9d095bf', // Muhammad Risqullah
                'dosen_pemonev_id' => '55c69fa3-c4de-4390-b36c-8343712c08bf', // Dr. Ahmad Fauzi
                'dosen_pembimbing_id' => '6d587477-431e-4de2-b0d6-f48e382c8811', // Dr. Siti Aminah
                'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
                'registration_id' => 'b2c3d4e5-f6a7-48b9-c0d1-e2f3a4b5c6d7',
                'notes' => 'Evaluation for Muhammad Risqullah',
                'status' => 'in_progress',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        foreach ($evaluations as $evaluation) {
            DB::connection($this->dbConn)->table('evaluations')->insert($evaluation);
        }
    }

    private function seedEvaluationScores(Carbon $now)
    {
        // Get evaluations
        $evaluations = DB::connection($this->dbConn)->table('evaluations')->get();

        foreach ($evaluations as $evaluation) {
            if ($evaluation->mahasiswa_id === '22af29d8-1e05-4d2b-b237-70955e0af315') {
                // Complete scores for Muhammad Rafif - all three subjects
                $subjectScores = [
                    [
                        'subject_id' => '3b057460-bedf-420e-beb2-83f44b490928',
                        'score' => 85.5,
                        'grade_letter' => 'B'
                    ],
                    [
                        'subject_id' => '2497f34b-c159-428f-8b05-bd2ce2d5b149',
                        'score' => 88.0,
                        'grade_letter' => 'AB'
                    ],
                    [
                        'subject_id' => '9c3d2f4e-425b-469b-8766-4794f07af5d9',
                        'score' => 80.0,
                        'grade_letter' => 'B'
                    ]
                ];

                foreach ($subjectScores as $subjectScore) {
                    DB::connection($this->dbConn)->table('evaluation_scores')->insert([
                        'id' => Str::uuid()->toString(),
                        'evaluation_id' => $evaluation->id,
                        'subject_id' => $subjectScore['subject_id'],
                        'score' => $subjectScore['score'],
                        'grade_letter' => $subjectScore['grade_letter'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            } else {
                // Pending scores for Muhammad Risqullah - some subjects graded, some pending
                $subjectScores = [
                    [
                        'subject_id' => '3b057460-bedf-420e-beb2-83f44b490928',
                        'score' => 82.0,
                        'grade_letter' => 'B'
                    ],
                    [
                        'subject_id' => '2497f34b-c159-428f-8b05-bd2ce2d5b149',
                        'score' => null,
                        'grade_letter' => null
                    ],
                    [
                        'subject_id' => '9c3d2f4e-425b-469b-8766-4794f07af5d9',
                        'score' => null,
                        'grade_letter' => null
                    ]
                ];

                foreach ($subjectScores as $subjectScore) {
                    DB::connection($this->dbConn)->table('evaluation_scores')->insert([
                        'id' => Str::uuid()->toString(),
                        'evaluation_id' => $evaluation->id,
                        'subject_id' => $subjectScore['subject_id'],
                        'score' => $subjectScore['score'],
                        'grade_letter' => $subjectScore['grade_letter'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }

    private function seedPartnerRatings(Carbon $now)
    {
        $ratings = [
            [
                'id' => Str::uuid()->toString(),
                'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
                'auth_user_id' => '22af29d8-1e05-4d2b-b237-70955e0af315', // Muhammad Rafif
                'rating' => 4,
                'comment' => 'Great performance and good initiative',
                'is_anonymous' => true,
                'is_published' => true,
                'approved_by' => 'c409a413-896f-4c37-8bf9-e41925f326c2',
                'approved_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => Str::uuid()->toString(),
                'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
                'auth_user_id' => '70c7739f-7812-4386-9665-b00af9d095bf', // Muhammad Risqullah
                'rating' => 3,
                'comment' => 'Good overall performance',
                'is_anonymous' => true,
                'is_published' => false,
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        foreach ($ratings as $rating) {
            DB::connection($this->dbConn)->table('partner_ratings')->insert($rating);
        }
    }

    public function down()
    {
        DB::connection($this->dbConn)->table('partner_ratings')->delete();
        DB::connection($this->dbConn)->table('evaluation_scores')->delete();
        DB::connection($this->dbConn)->table('evaluations')->delete();
    }
};

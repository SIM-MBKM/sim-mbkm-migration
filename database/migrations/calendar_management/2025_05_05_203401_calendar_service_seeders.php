<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
    protected $dbConn = 'calendar_management';

    public function up()
    {
        $now = Carbon::now();

        // Seed events
        $this->seedEvents($now);

        // Seed event participants
        $this->seedEventParticipants($now);
    }

    public function down()
    {
        DB::connection($this->dbConn)->table('event_participants')->delete();
        DB::connection($this->dbConn)->table('events')->delete();
    }

    private function seedEvents(Carbon $now)
    {
        // Admin user creates these events
        $adminUserId = '22af29d8-1e05-4d2b-b237-70955e0af315'; // Muhammad Rafif

        $events = [
            // Program Evaluation Session
            [
                'id' => '9c55707b-6480-4de0-ae82-6f478d2299c2',
                'title' => 'Program Evaluation - Learning and Development Intern',
                'description' => 'Final evaluation session for the Learning and Development Intern program participants',
                'event_date' => '2025-08-01', // 5 months after activity starts (March 1)
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'location' => 'Departemen Building, Room 201',
                'meeting_link' => 'https://meet.google.com/evaluation-session',
                'status' => 'active',
                'event_type' => 'evaluation',
                'creator_auth_user_id' => $adminUserId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Technical Assessment Event
            [
                'id' => '82a6a81d-1cc7-4b95-a38b-7f028d0a4a88',
                'title' => 'Technical Assessment - Project Management Evaluation',
                'description' => 'Assessment for Project Management component of the internship program',
                'event_date' => '2025-07-20', // 2 weeks before final evaluation
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'location' => 'Computer Lab 1',
                'meeting_link' => null,
                'status' => 'active',
                'event_type' => 'assessment',
                'creator_auth_user_id' => $adminUserId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Business Communication Event
            [
                'id' => '77df63fa-1b8b-41aa-978f-0e30a9222495',
                'title' => 'Business Communication Presentation',
                'description' => 'Final presentation for Business Communication component',
                'event_date' => '2025-07-25',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'location' => 'Auditorium',
                'meeting_link' => 'https://meet.google.com/business-comm-presentation',
                'status' => 'active',
                'event_type' => 'presentation',
                'creator_auth_user_id' => $adminUserId,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Monthly Review Meeting
            [
                'id' => 'c4f58c99-fc45-4b78-b7e4-7cb729e7c878',
                'title' => 'Monthly Program Review - June',
                'description' => 'Monthly review of intern progress and challenges',
                'event_date' => '2025-06-15',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
                'location' => 'Conference Room A',
                'meeting_link' => 'https://meet.google.com/monthly-review',
                'status' => 'active',
                'event_type' => 'review',
                'creator_auth_user_id' => $adminUserId,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::connection($this->dbConn)->table('events')->insert($events);
    }

    private function seedEventParticipants(Carbon $now)
    {
        // Get all events
        $events = DB::connection($this->dbConn)->table('events')->get();

        $participants = [];

        foreach ($events as $event) {
            // Add the two students to all events
            $participants[] = [
                'id' => Str::uuid()->toString(),
                'event_id' => $event->id,
                'auth_user_id' => '22af29d8-1e05-4d2b-b237-70955e0af315', // Muhammad Rafif
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $participants[] = [
                'id' => Str::uuid()->toString(),
                'event_id' => $event->id,
                'auth_user_id' => '70c7739f-7812-4386-9665-b00af9d095bf', // Muhammad Risqullah
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Add academic staff to relevant events
            if (in_array($event->event_type, ['evaluation', 'assessment', 'review'])) {
                // Add dosen pembimbing
                $participants[] = [
                    'id' => Str::uuid()->toString(),
                    'event_id' => $event->id,
                    'auth_user_id' => '6d587477-431e-4de2-b0d6-f48e382c8811', // Dr. Siti Aminah
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                // Add dosen pemonev
                $participants[] = [
                    'id' => Str::uuid()->toString(),
                    'event_id' => $event->id,
                    'auth_user_id' => '55c69fa3-c4de-4390-b36c-8343712c08bf', // Dr. Ahmad Fauzi
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // Add partner for evaluation events
            if ($event->event_type === 'evaluation') {
                $participants[] = [
                    'id' => Str::uuid()->toString(),
                    'event_id' => $event->id,
                    'auth_user_id' => 'c409a413-896f-4c37-8bf9-e41925f326c2', // Partner Representative
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::connection($this->dbConn)->table('event_participants')->insert($participants);
    }
};

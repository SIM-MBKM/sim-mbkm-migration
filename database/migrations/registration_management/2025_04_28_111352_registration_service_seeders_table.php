<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
  protected $dbConn = 'registration_management';

  public function up()
  {
    $now = Carbon::now();

    // Seed registrations for both users
    // $this->seedRegistrations($now);

    // Seed documents
    // $this->seedDocuments($now);
  }

  private function seedRegistrations(Carbon $now)
  {
    $registrations = [
      [
        'id' => 'a1b2c3d4-e5f6-47a8-b9c0-d1e2f3a4b5c6',
        'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
        'activity_name' => 'Learning and Development Intern Terbaru',
        'user_id' => '22af29d8-1e05-4d2b-b237-70955e0af315', // Muhammad Rafif
        'user_name' => 'Muhammad Rafif Tri Risqullah',
        'user_nrp' => '5026201054',
        'advising_confirmation' => true,
        'academic_advisor_id' => '6d587477-431e-4de2-b0d6-f48e382c8811',
        'academic_advisor' => 'Dr. Siti Aminah',
        'academic_advisor_email' => 'siti.aminah@example.com',
        'mentor_name' => 'Partner Representative',
        'mentor_email' => 'partner@perusahaana.com',
        'academic_advisor_validation' => 'APPROVED',
        'lo_validation' => 'APPROVED',
        'semester' => 6,
        'total_sks' => 120,
        'approval_status' => true
      ],
      [
        'id' => 'b2c3d4e5-f6a7-48b9-c0d1-e2f3a4b5c6d7',
        'activity_id' => '10d9bd2a-9f38-4a47-88e9-6868c1bceebc',
        'activity_name' => 'Learning and Development Intern Terbaru',
        'user_id' => '70c7739f-7812-4386-9665-b00af9d095bf', // Muhammad Risqullah
        'user_name' => 'Muhammad Risqullah',
        'user_nrp' => '5026201055',
        'advising_confirmation' => true,
        'academic_advisor_id' => '6d587477-431e-4de2-b0d6-f48e382c8811',
        'academic_advisor' => 'Dr. Siti Aminah',
        'academic_advisor_email' => 'siti.aminah@example.com',
        'mentor_name' => 'Partner Representative',
        'mentor_email' => 'partner@perusahaana.com',
        'academic_advisor_validation' => 'APPROVED',
        'lo_validation' => 'APPROVED',
        'semester' => 5,
        'total_sks' => 100,
        'approval_status' => true
      ]
    ];

    foreach ($registrations as $registration) {
      DB::connection($this->dbConn)->table('registrations')->insert([
        'id' => $registration['id'],
        'activity_id' => $registration['activity_id'],
        'activity_name' => $registration['activity_name'],
        'user_id' => $registration['user_id'],
        'user_name' => $registration['user_name'],
        'user_nrp' => $registration['user_nrp'],
        'advising_confirmation' => $registration['advising_confirmation'],
        'academic_advisor_id' => $registration['academic_advisor_id'],
        'academic_advisor' => $registration['academic_advisor'],
        'academic_advisor_email' => $registration['academic_advisor_email'],
        'mentor_name' => $registration['mentor_name'],
        'mentor_email' => $registration['mentor_email'],
        'academic_advisor_validation' => $registration['academic_advisor_validation'],
        'lo_validation' => $registration['lo_validation'],
        'semester' => $registration['semester'],
        'total_sks' => $registration['total_sks'],
        'approval_status' => $registration['approval_status'],
        'created_at' => $now,
        'updated_at' => $now,
      ]);
    }
  }

  private function seedDocuments(Carbon $now)
  {
    $registrations = DB::connection($this->dbConn)->table('registrations')->get();
    $documentTypes = ['CV', 'TRANSKRIP', 'SURAT_REKOMENDASI', 'PORTFOLIO', 'SERTIFIKAT'];

    foreach ($registrations as $registration) {
      foreach ($documentTypes as $documentType) {
        DB::connection($this->dbConn)->table('documents')->insert([
          'id' => Str::uuid()->toString(),
          'file_storage_id' => Str::uuid()->toString(),
          'name' => $this->generateDocumentName($registration->user_name, $documentType),
          'document_type' => $documentType,
          'registration_id' => $registration->id,
          'created_at' => $now,
          'updated_at' => $now,
        ]);
      }
    }
  }

  private function generateDocumentName($userName, $documentType)
  {
    $userName = str_replace(' ', '_', strtolower($userName));
    $extension = 'pdf';

    switch ($documentType) {
      case 'CV':
        return "cv_{$userName}.{$extension}";
      case 'TRANSKRIP':
        return "transkrip_{$userName}.{$extension}";
      case 'SURAT_REKOMENDASI':
        return "surat_rekomendasi_{$userName}.{$extension}";
      case 'PORTFOLIO':
        return "portfolio_{$userName}.{$extension}";
      case 'SERTIFIKAT':
        return "sertifikat_{$userName}.{$extension}";
      default:
        return "dokumen_{$userName}.{$extension}";
    }
  }

  public function down()
  {
    DB::connection($this->dbConn)->table('documents')->delete();
    DB::connection($this->dbConn)->table('registrations')->delete();
  }
};

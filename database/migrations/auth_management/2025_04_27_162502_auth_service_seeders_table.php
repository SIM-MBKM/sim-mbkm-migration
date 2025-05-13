<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
  protected $dbConn = 'auth_management';

  public function up()
  {
    $now = Carbon::now();

    // User 1 - Muhammad Rafif Tri Risqullah (original user)
    $firstUserId = '22af29d8-1e05-4d2b-b237-70955e0af315';
    $this->seedUser($firstUserId, 'Muhammad Rafif Tri Risqullah', 'zeonkunix@gmail.com', '117767847754292974022', $now);

    // User 2 - Muhammad Risqullah (new user)
    $secondUserId = '70c7739f-7812-4386-9665-b00af9d095bf';
    $this->seedUser($secondUserId, 'Muhammad Risqullah', 'rafif.zeon@gmail.com', '112852944157220723261', $now);

    // Additional test users with specific roles
    $this->seedAdditionalUsers($now);
  }

  private function seedUser($userId, $name, $email, $ssoId, $now)
  {
    // Insert user
    DB::connection($this->dbConn)->table('users')->insert([
      'id' => $userId,
      'name' => $name,
      'email' => $email,
      'sso_id' => $ssoId,
      'remember_token' => null,
      'created_at' => $now,
      'updated_at' => $now,
    ]);

    // Insert user identity
    DB::connection($this->dbConn)->table('user_identities')->insert([
      'id' => Str::uuid()->toString(),
      'user_id' => $userId,
      'provider' => 'google',
      'provider_user_id' => $ssoId,
      'access_token' => 'sample-access-token-google',
      'refresh_token' => 'sample-refresh-token-google',
      'expires_at' => $now->addDays(7),
      'provider_data' => json_encode([
        'name' => $name,
        'email' => $email,
        'picture' => 'https://lh3.googleusercontent.com/a/profile-picture-url',
      ]),
      'created_at' => $now,
      'updated_at' => $now,
    ]);
  }

  private function seedAdditionalUsers($now)
  {
    $additionalUsers = [
      [
        'id' => '55c69fa3-c4de-4390-b36c-8343712c08bf',
        'name' => 'Dr. Ahmad Fauzi',
        'email' => 'ahmad.fauzi@example.com',
        'role' => 'dosen_pemonev'
      ],
      [
        'id' => '6d587477-431e-4de2-b0d6-f48e382c8811',
        'name' => 'Dr. Siti Aminah',
        'email' => 'siti.aminah@example.com',
        'role' => 'dosen_pembimbing'
      ],
      [
        'id' => 'c409a413-896f-4c37-8bf9-e41925f326c2',
        'name' => 'Partner Representative',
        'email' => 'partner@perusahaana.com',
        'role' => 'partner'
      ]
    ];

    foreach ($additionalUsers as $user) {
      DB::connection($this->dbConn)->table('users')->insert([
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'sso_id' => null,
        'remember_token' => null,
        'created_at' => $now,
        'updated_at' => $now,
      ]);
    }
  }

  public function down()
  {
    DB::connection($this->dbConn)->table('users')->delete();
  }
};

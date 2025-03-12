<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'pgsql';
  protected $table = 'notifications';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('receiver_id');
      $table->uuid('sender_id');
      $table->string('title');
      $table->text('content');
      $table->enum('status', ['read', 'unread']);
      $table->date('sent_at')->nullable();
      $table->string('type');
      $table->timestamps();

      $table->foreign('receiver_id')->references('id')->on('users')->onDelete('CASCADE');
      $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresencesTable extends Migration
{
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Assuming you have a users table
            $table->date('attendance_date');
            $table->enum('shift', ['morning', 'afternoon', 'evening']);
            $table->enum('status', ['present', 'permission', 'sick', 'cuti']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presences');
    }
}
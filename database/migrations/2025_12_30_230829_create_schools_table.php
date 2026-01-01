<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('npsn')->unique()->nullable();
            $table->string('kabupaten')->default('SUKOHARJO');
            $table->string('provinsi')->default('JAWA TENGAH');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('kelurahan')->nullable();
            $table->geometry('geom');
            $table->integer('student_count')->default(0);
            $table->integer('class_count')->default(0);
            $table->integer('teacher_count')->nullable()->default(0);
            $table->string('type', 50)->nullable();
            $table->string('status', 20)->nullable();
            $table->json('facilities')->nullable();
            $table->integer('lab_count')->default(0);
            $table->integer('library_count')->default(0);
            $table->integer('sanitation_count')->default(0);
            $table->text('description')->nullable();
            $table->year('established_year')->nullable();

            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();

            $table->spatialIndex('geom');
        });
    }

    public function down(): void {
        Schema::dropIfExists('schools');
    }
};

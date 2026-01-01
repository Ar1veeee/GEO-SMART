<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('office', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->geometry('geom');
            $table->timestamps();

            $table->spatialIndex('geom');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('office');
    }
};

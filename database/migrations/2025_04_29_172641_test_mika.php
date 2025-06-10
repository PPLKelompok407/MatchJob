<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_mikat', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->string('opsi_1');
            $table->string('opsi_2');
            $table->string('opsi_3');
            $table->string('opsi_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

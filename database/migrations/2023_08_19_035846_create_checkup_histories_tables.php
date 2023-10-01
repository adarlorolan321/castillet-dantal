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
        Schema::create('checkup_histories', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            
            $table->string('service_id');
            $table->string('title');
            $table->longText('description');
            $table->string('date');
            $table->json('prescription')->nullable();
            $table->longText('xray');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkup_histories', function (Blueprint $table) {
            Schema::dropIfExists('checkup_histories');
        });
    }
};

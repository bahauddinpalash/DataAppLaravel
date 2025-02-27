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
        Schema::create('recruit_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruit_lead_id')->constrained('recruit_leads')->onDelete('cascade');
            $table->enum('activity_type', ['phone call', 'email', 'whatsapp', 'others']);
            $table->text('activity_description');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruit_activities');
    }
};

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
        Schema::create('client_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bdm_lead_id')->constrained('bdm_leads')->onDelete('cascade');
            $table->enum('response_type', ['phone call', 'email', 'whatsapp', 'others']);
            $table->text('response_description');
            $table->string('received_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_responses');
    }
};

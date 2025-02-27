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
        Schema::create('recruit_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade'); // Foreign key for candidate
            $table->string('lead_status')->default('open'); // Lead status, default is 'open'
            $table->dateTime('candidate_meeting')->nullable()->default(null); // Nullable meeting field for candidate
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('position')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruit_leads');
    }
};

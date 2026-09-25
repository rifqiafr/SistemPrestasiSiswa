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
        // 1. Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Akademik, Olahraga, Seni, Riset
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 20)->unique();
            $table->string('full_name');
            $table->string('class_grade'); // e.g. XII-MIPA 1, XI-IPS 2
            $table->year('cohort_year'); // e.g. 2026
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->timestamps();
        });

        // 3. Achievements
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('rank_grade'); // Juara 1, Medali Emas, Finalis, dsb.
            $table->enum('competition_level', ['Sekolah', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional']);
            $table->string('organizer');
            $table->date('event_date');
            $table->text('description')->nullable();
            $table->string('mentor_name')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 4. Achievement Participants (Pivot Table)
        Schema::create('achievement_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['achievement_id', 'student_id']);
        });

        // 5. Achievement Media
        Schema::create('achievement_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('cascade');
            $table->string('file_url');
            $table->enum('file_type', ['photo', 'certificate'])->default('photo');
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement_media');
        Schema::dropIfExists('achievement_participants');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('students');
        Schema::dropIfExists('categories');
    }
};

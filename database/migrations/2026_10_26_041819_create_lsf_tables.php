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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('title');
            $table->string('filename');
            $table->bigInteger('file_size_bytes')->default(0);
            $table->string('file_size_formatted')->default('0 MB');
            $table->string('format')->default('MP4');
            $table->string('duration')->default('00:00:00');
            $table->string('resolution')->default('1920x1080');
            $table->string('sha256_hash')->nullable();
            $table->string('storage_path')->nullable();
            $table->string('recommended_rating')->default('13+');
            $table->string('final_rating')->nullable();
            $table->float('confidence_rate')->default(90.0);
            $table->string('status')->default('completed'); // 'completed', 'processing', 'flagged', 'validating'
            $table->string('medium')->default('Layar Lebar'); // 'Layar Lebar', 'Televisi', 'JTI'
            $table->string('genre')->default('Drama');
            $table->json('elements')->nullable();
            $table->string('reviewer_name')->nullable();
            $table->text('reviewer_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('scene_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained('videos')->onDelete('cascade');
            $table->string('timecode')->default('00:00');
            $table->text('scene_summary');
            $table->string('tag')->default('Dialog');
            $table->string('risk_level')->default('Rendah'); // 'Rendah', 'Sedang', 'Tinggi'
            $table->json('evidence_frames')->nullable();
            $table->text('reviewer_notes')->nullable();
            $table->boolean('is_flagged')->default(false);
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->nullable()->constrained('videos')->onDelete('cascade');
            $table->string('action');
            $table->string('user_name');
            $table->text('details')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('scene_reports');
        Schema::dropIfExists('videos');
    }
};

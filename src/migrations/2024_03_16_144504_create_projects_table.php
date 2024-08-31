<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Project\Enums\ProjectVisibilities;
use Modules\Project\Enums\ProjectStatuses;
use Modules\Project\Enums\ProjectTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->text('description')->nullable();
            $table->string('research_area')->nullable();
            $table->text('objectives')->nullable();
            $table->text('methods')->nullable();
            $table->text('expected_outcomes')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('projectable_id')->nullable();
            $table->string('projectable_type')->nullable();
            // $table->unsignedBigInteger('owner_id');
            // $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('visibility', ProjectVisibilities::names())->default(ProjectVisibilities::private ->name);
            $table->enum('status', ProjectStatuses::names())->default(ProjectStatuses::in_progress->name);
            // $table->enum('type', ProjectTypes::names());
            // $table->json('active_modules');
            $table->string('project_type');
            //            $table->enum('status', ProjectStatuses::names());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

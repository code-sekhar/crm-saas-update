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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Lead / Task / User
            $table->string('module');

            // create update delete login export...
            $table->string('action');

            // Lead ID / Task ID
            $table->unsignedBigInteger('record_id')
                ->nullable();

            // Human readable
            $table->text('description');

            $table->ipAddress('ip_address')
                ->nullable();

            $table->string('browser')
                ->nullable();

            $table->string('platform')
                ->nullable();

            $table->json('old_values')
                ->nullable();

            $table->json('new_values')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};

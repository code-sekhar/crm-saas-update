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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('company_name');

            $table->string('logo')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('website')->nullable();

            $table->string('gst_number')->nullable();

            $table->string('currency')->default('INR');

            $table->string('timezone')->default('Asia/Kolkata');

            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};

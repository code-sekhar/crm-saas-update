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
        Schema::create('login_activities', function (Blueprint $table) {

            $table->id();

            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->ipAddress('ip_address')->nullable();

            $table->string('browser')->nullable();

            $table->string('platform')->nullable();

            $table->string('device')->nullable();

            $table->string('country')->nullable();

            $table->string('city')->nullable();

            $table->timestamp('login_at');

            $table->timestamp('logout_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_activities');
    }
};

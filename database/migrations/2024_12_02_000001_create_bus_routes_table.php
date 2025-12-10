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
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name');
            $table->string('bus_number');
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('duration_minutes');
            $table->decimal('fare', 8, 2);
            $table->integer('available_seats');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('days_operating')->default('Monday-Friday'); // Operating days
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_routes');
    }
};

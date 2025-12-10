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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_route_id')->constrained('bus_routes')->onDelete('cascade');
            $table->string('student_name');
            $table->string('student_id');
            $table->string('student_email');
            $table->string('student_phone');
            $table->integer('seat_number');
            $table->date('booking_date');
            $table->enum('status', ['confirmed', 'cancelled', 'pending'])->default('confirmed');
            $table->decimal('amount_paid', 8, 2);
            $table->timestamps();
            
            // Ensure no duplicate seat bookings for same route on same date
            $table->unique(['bus_route_id', 'seat_number', 'booking_date'], 'unique_seat_booking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained('tour_packages')->onDelete('cascade');
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->integer('participants');
       
        $table->decimal('total_price', 10, 2);
        $table->string('status')->default('Pending');
        $table->timestamps();
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

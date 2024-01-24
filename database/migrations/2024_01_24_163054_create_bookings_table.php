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
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('booking_code')->nullable()->unique();
            
            $table->string('customer_message')->nullable();
            $table->string('manager_message')->nullable();
            $table->enum('status', ['pending','cancelled','confirmed'])->default('pending');

            $table->date('booking_date')->nullable();
            $table->date('confirm_date')->nullable();
            $table->date('cancel_date')->nullable();

            $table->integer('quantity')->nullable();
            $table->decimal('total_price',8,2)->nullable();

            $table->index(['facility_id', 'service_id','booking_code']);
            $table->softDeletes();
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

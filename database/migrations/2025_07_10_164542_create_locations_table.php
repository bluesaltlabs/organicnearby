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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('label')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('map_icon')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->morphs('locationable'); // Adds locationable_id and locationable_type
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

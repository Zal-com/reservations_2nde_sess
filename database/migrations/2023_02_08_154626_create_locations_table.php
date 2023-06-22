<?php

use App\Models\Locality;
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
        Schema::create(
            'locations',
            static function (
                Blueprint $table
            ) {
                $table->id();
                $table->string('slug', 60);
                $table->string('designation', 60);
                $table->string('address', 255);
                $table->foreignId('locality_id');
                $table->string('website', 255)->nullable();
                $table->string('phone', 30)->nullable();
                $table->index('locality_id');
                // index
                //$table->foreignId('locality_id');
                // Constraints
                $table->foreign('locality_id')
                    ->references('id')
                    ->on('localities')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
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

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
        Schema::create(
            'shows',
            static function (
                Blueprint $table
            ) {
                $table->id();
                $table->string('slug', 60)->unique();
                $table->string('title', 255);
                $table->text('description')->nullable();
                $table->string('poster_url', 255)->nullable();
                $table->foreignId('location_id')->nullable();
                $table->tinyInteger('bookable')->default(0);
                $table->decimal('price', 10)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->nullable();

                // Constraints
                $table->foreign('location_id')
                    ->references('id')
                    ->on('locations')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};

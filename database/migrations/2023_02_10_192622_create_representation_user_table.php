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
            'representation_user',
            static function (
                Blueprint $table
            ) {
                $table->id();
                $table->foreignId('representation_id');
                $table->foreignId('user_id');
                $table->integer('seats');
                $table->double('unit_price');
                $table->double('quantity');
                $table->string('payment_id');
                $table->tinyInteger('status')->default(1);
                // constraints
                $table->foreign('representation_id')
                    ->references('id')
                    ->on('representations')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representation_user');
    }
};

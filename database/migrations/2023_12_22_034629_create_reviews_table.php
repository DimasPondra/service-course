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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer("rate")->default(1);
            $table->longText("note")->nullable();
            $table->integer("user_id");

            $table->foreignId("course_id")
                ->constrained("courses")
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->unique(["user_id", "course_id"]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

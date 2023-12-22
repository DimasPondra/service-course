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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("slug");
            $table->longText("description")->nullable();
            $table->enum("type", ["free", "premium"]);
            $table->boolean("certificate");
            $table->enum("level", ["all-level", "beginner", "intermediate", "advance"]);
            $table->enum("status", ["draft", "published"])->default("draft");
            $table->decimal("price", 16,2);
            $table->integer("thubmnail_file_id");
            $table->integer("mentor_user_id");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

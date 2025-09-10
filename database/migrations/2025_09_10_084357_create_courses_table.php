<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("courses", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->text("short_description")->nullable();
            $table->longText("description")->nullable();
            $table->foreignId("category_id")->nullable()->constrained("categories")->onDelete("cascade");
            $table->enum("level", ["beginner", "intermediate", "advanced"])->default("beginner");
            $table->integer("duration")->nullable();
            $table->decimal("price", 8, 2)->default(0);
            $table->boolean("is_free")->default(false);
            $table->decimal("discount_price", 8, 2)->nullable();
            $table->enum("status", ["draft", "published", "archived"])->default("draft");
            $table->json("meta")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp("published_at")->nullable();
            $table->timestamp("expires_at")->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("courses");
    }
};

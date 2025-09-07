<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Таблица за роли
        Schema::create("roles", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique(); // Например: admin, user
            $table->string("label")->nullable(); // Човешко четимо име
            $table->timestamps();
        });

        // Таблица за разрешения
        Schema::create("permissions", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique(); // Например: edit_posts
            $table->string("label")->nullable(); // Човешко четимо име
            $table->timestamps();
        });

        // Pivot таблица role_user (Many-to-Many)
        Schema::create("role_user", function (Blueprint $table) {
            $table->foreignId("role_id")->constrained()->cascadeOnDelete();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->primary(["role_id", "user_id"]);
        });

        // Pivot таблица permission_role (Many-to-Many)
        Schema::create("permission_role", function (Blueprint $table) {
            $table->foreignId("permission_id")->constrained()->cascadeOnDelete();
            $table->foreignId("role_id")->constrained()->cascadeOnDelete();
            $table->primary(["permission_id", "role_id"]);
        });
    }

    public function down()
    {
        Schema::dropIfExists("permission_role");
        Schema::dropIfExists("role_user");
        Schema::dropIfExists("permissions");
        Schema::dropIfExists("roles");
    }
};

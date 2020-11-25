<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->json('http_method')->nullable();
            $table->json('http_path')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->timestamps();
        });

        Schema::create('admin_model_has_role', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_role_id')->index();
            $table->unsignedBigInteger('taggable_id')->index();
            $table->string('taggable_type', 64);
        });

        Schema::create('admin_model_has_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_permission_id')->index();
            $table->unsignedBigInteger('taggable_id')->index();
            $table->string('taggable_type', 64);
        });

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0)->index();
            $table->string('title', 50);
            $table->string('name', 50);
            $table->string('component', 50);
            $table->string('path', 100)->default('');
            $table->string('redirect', 100)->default('');
            $table->string('icon', 50)->default('');
            $table->boolean('is_cache')->default(false);
            $table->boolean('is_show')->default(true);
            $table->tinyInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_model_has_role');
        Schema::dropIfExists('admin_model_has_permission');
        Schema::dropIfExists('admin_menus');
    }
}

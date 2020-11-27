<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_systems', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->char('ext');
            $table->string('path');
            $table->unsignedInteger('size');
            $table->string('mime_type', 100)->nullable();
            $table->string('md5')->index();
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
        Schema::dropIfExists('file_systems');
    }
}

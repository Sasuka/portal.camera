<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_store', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name');
            $table->enum('file_type',['mp4']);
            $table->dateTime('write_time');
            $table->text('file_path');
            $table->text('vod_path');
            $table->tinyInteger('vod_path_uploaded')->default(0);
            $table->bigInteger('file_size')->default(0);
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('is_play_back')->default(1);
            $table->dateTime('start_write_time');
            $table->integer('file_exists')->default(0);
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('camera_id');
            $table->unsignedBigInteger('guid_id');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_store');
    }
}

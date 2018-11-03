<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('camera_name', 125)->nullable(false);
            $table->string('stream_name');
            $table->ipAddress('ip');
            $table->integer('port');
            $table->boolean('status')->default(1);
            $table->unsignedInteger('customer_id')->nullable(false);
            $table->unsignedInteger('model_id');
            $table->unsignedInteger('created_by')->nullable(false);
            $table->unsignedInteger('updated_by')->nullable(false);
            $table->unsignedBigInteger('streamer_instance_id')->nullable(false);
            $table->string('stream_source')->nullable(false);
            $table->integer('time_storage')->default(7);
            $table->boolean('is_set_time_storage')->default(0);
            $table->boolean('published')->default(1);
            $table->boolean('deleted')->default(0);
            $table->boolean('stream_added')->default(0);
            $table->boolean('stream_connected')->default(0);
            $table->boolean('stream_recorded')->default(0);
            $table->boolean('stream_recording')->default(0);
            $table->boolean('stream_startup_added')->default(0);
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('vod_streamer_instance_id')->default(1);
            $table->boolean('disconnected')->default(0);
            $table->integer('type')->default('1');
            $table->longText('live_stream_mjpeg_uri');
            $table->boolean('alive')->default(1);
            $table->dateTime('last_updated_alive');
            $table->dateTime('last_updated_send_warning_not_record');
            $table->dateTime('last_updated_send_warning_camera_down');
            $table->dateTime('last_updated_send_notify_camera_on');
            $table->boolean('has_PTZ')->default(0);
            $table->boolean('is_view_live')->default(1);
            $table->boolean('stop_alarm')->default(0);
            $table->string('avatar');
            $table->string('protocol', 20)->default(0);
            $table->integer('type_recorded')->default(0);
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
        Schema::dropIfExists('cameras');
    }
}

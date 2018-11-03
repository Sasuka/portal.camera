<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleCameraPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_camera_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('camera_id');
            $table->boolean('allow_view')->default(0);
            $table->boolean('allow_edit')->default(0);
            $table->boolean('allow_add')->default(0);
            $table->boolean('allow_del')->default(0);
            $table->boolean('allow_ptz')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestampsTz();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('camera_id')->references('id')->on('cameras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_camera_permissions');
    }
}

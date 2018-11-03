<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleLocationPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_location_permissions', function (Blueprint $table) {
            $table->primary(['role_id', 'location_id']);
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('location_id');
            $table->boolean('allow_view')->default(0);
            $table->boolean('allow_edit')->default(0);
            $table->boolean('allow_add')->default(0);
            $table->boolean('allow_del')->default(0);
            $table->boolean('allow_ptz')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestampsTz();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_location_permissions',function (Blueprint $table) {
            $table->dropForeign('role_id');
            $table->dropForeign('location_id');
        });
    }
}

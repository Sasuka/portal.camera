<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRecordRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_record_role', function (Blueprint $table) {
            $table->primary(['permission_record_id', 'role_id']);
            $table->unsignedInteger('permission_record_id');
            $table->unsignedInteger('role_id');
            $table->foreign('permission_record_id')->references('id')->on('permissions_record')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_record_role',function (Blueprint $table) {
            $table->dropForeign('permission_record_id');
            $table->dropForeign('role_id');
        });

    }
}

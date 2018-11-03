<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleCustomerPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_customer_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->nullable(false);
            $table->unsignedInteger('customer_id')->nullable(false);
            $table->boolean('allow_view')->default(0);
            $table->boolean('allow_edit')->default(0);
            $table->boolean('allow_add')->default(0);
            $table->boolean('allow_del')->default(0);
            $table->boolean('allow_ptz')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestampsTz();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('role_customer_permissions',function (Blueprint $table) {
            $table->dropForeign('customer_id');
            $table->dropForeign('role_id');
        });
    }
}

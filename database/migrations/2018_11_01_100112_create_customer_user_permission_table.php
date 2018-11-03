<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_user_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable(false);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->boolean('allow_view')->default(0);
            $table->boolean('allow_edit')->default(0);
            $table->boolean('allow_add')->default(0);
            $table->boolean('allow_del')->default(0);
            $table->boolean('allow_ptz')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
        Schema::dropIfExists('customer_user_permission');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_role', function (Blueprint $table) {
            $table->primary(['customer_id', 'role_id']);
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('role_id');
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
        Schema::dropIfExists('customer_role',function (Blueprint $table) {
            $table->dropForeign('customer_id');
            $table->dropForeign('role_id');
        });
    }
}

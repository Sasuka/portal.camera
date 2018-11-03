<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('location_id')->nullable(false);
            $table->unsignedBigInteger('notification_id')->nullable(false);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_push')->default(0);
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_notification',function (Blueprint $table) {
            $table->dropForeign('location_id');
            $table->dropForeign('notification_id');
        });
    }
}

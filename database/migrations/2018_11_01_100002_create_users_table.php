<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('customer_guid',38);
            $table->string('user_name')->nullable();
            $table->string('email',20)->unique();
            $table->string('password');
            $table->tinyInteger('password_format_id')->default(0);
            $table->text('password_salt')->nullable();
            $table->longText('admin_comment')->nullable();
            $table->string('full_name');
            $table->text('address')->nullable();
            $table->string('card_id',20)->nullable();
            $table->string('mobile_phone',15)->nullable();
            $table->string('home_phone',15)->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->default(0);
            $table->boolean('is_system_account');
            $table->boolean('limit_login')->default(1);
            $table->boolean('allow_change_password')->default(1);
            $table->dateTimeTz('last_login')->default(today());
            $table->string('email_warning',30);
            $table->boolean('get_mail_warning_enabled')->default(0);
            $table->boolean('get_warning_camera_dowload_enabled')->default(1);
            $table->boolean('get_warning_camera_not_record_enabled')->default(1);
            $table->boolean('get_warning_camera_large_file_store_enabled')->default(1);
            $table->boolean('receive_warning_again_time')->default(30);
            $table->boolean('is_checked_password_api')->default(1);
            $table->string('token_iot',100)->nullable();
            $table->unsignedInteger('user_id_iot')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('customer_domain_id')->nullable();


//            $table->string('name');
//            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

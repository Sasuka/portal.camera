<?php

use Illuminate\Database\Seeder;
use App\Customers;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Customers::insert([
            'customer_guid' => 'f1eea2f7-fd89-4fb3-9624-c81a81ca4405',
            'email' => 'tailt9@fpt.com.vn',
            'user_name' => 'tailt9@fpt.com.vn',
            'password' => bcrypt(123123),
            'password_format_id' => 2,
            'password_salt' => 'yHt/eoE=',
            'admin_comment' => 'admin',
            'full_name' => 'Tai Shiro Takaki',
            'address' => '123 ABC',
            'card_id' => '123123123',
            'mobile_phone' => '0987654321',
            'home_phone' => '1234567890',
            'is_system_account' => 1,
            'limit_login' => 1,
            'email_warning' => 'tailt9@fpt.com.vn',
        ]);
//        foreach ($customers as $key => $value) {
//            Customers::created($value);
//        }
    }
}

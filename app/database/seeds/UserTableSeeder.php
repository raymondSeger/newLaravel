<?php
/*
 * Raymond
 * This class will call it's run() method when user (you) typed "php artisan db:seed" inside the vagrant SSH
 */

class UserTableSeeder extends Seeder {

    public function run()
    {
        /*
         * Raymond.
         * sets the ID to 0.
         * then Emptied the table
         * then create the data for the table
         * and finally inserts the data to the  table
         */
        DB::statement("SET foreign_key_checks = 0");
        DB::table('users')->truncate();
        $data = [
            [
                'username'      => 'raymondSeger',
                'name'          => 'Raymond Seger',
                'email'         => 'raymondseger@live.com',
                'password'      => '1234567',
                'birthday'      => '1990-02-24',
                'validate_user' => 'validationCodeToTestIfNotBot',
                'user_status'   => 'available',
                'created_at'    => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'    => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'username'      => 'lukmanVita',
                'name'          => 'Lukman',
                'email'         => 'lukman@vitajaya.com',
                'password'      => '123456',
                'birthday'      => '1990-02-24',
                'validate_user' => 'validationCodeToTestIfNotBot',
                'user_status'   => 'available',
                'created_at'    => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'    => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'username'      => 'agungTris',
                'name'          => 'Wahyu Agung Trisnandha',
                'email'         => 'Trisnandha@vitajaya.com',
                'password'      => '123456789',
                'birthday'      => '1990-01-20',
                'validate_user' => 'validationCodeToTestIfNotBot',
                'user_status'   => 'banned',
                'created_at'    => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'    => \Carbon\Carbon::now()->toDateTimeString()
            ],

        ];
        DB::table('users')->insert($data);
    }
}
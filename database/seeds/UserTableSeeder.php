<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name'      => 'admin_jetbean',
                'email'     => 'notauth@gmail.com',
                'password'  => bcrypt('admin_jetbean'),
                'image'     => 'minion3.jpg'
            ]);
    }
}

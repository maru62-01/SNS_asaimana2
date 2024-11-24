<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
    'username' => 'tarou', //usernameはカラム名
    'mail'   =>  'hello@ai',//email1はカラム名
    'password' => bcrypt('1234'), //パスポートのハッシュ化
   ]);
   DB::table('users')->insert([
    'username' => 'itirou',
    'mail'   =>  'hello@ue',
    'password' => bcrypt('5678'),
   ]);
   DB::table('users')->insert([
    'username' => 'jirou',
    'mail'   =>  'hello@oo',
    'password' => bcrypt('9012'),
   ]);
    }
}

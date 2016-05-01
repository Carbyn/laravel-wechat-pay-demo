<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        
        DB::table('users')->delete();
        $user = ['phone' => '18618482206', 'password' => Hash::make('carbyn')];
        User::create($user);
    }
}

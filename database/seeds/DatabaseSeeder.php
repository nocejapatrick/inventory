<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $items = factory(App\Item::class,100)->create();
        $faker = Faker::create();
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'admin@yahoo.com',
            'api_token'=>str_random(32),
            'password' => bcrypt('admin123'),
            'role'=>'Admin'
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'user1@yahoo.com',
            'api_token'=>str_random(32),
            'password' => bcrypt('user123'),
            'role'=>'User'
        ]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'user2@yahoo.com',
            'api_token'=>str_random(32),
            'password' => bcrypt('user123'),
            'role'=>'User'
        ]);
    }
}

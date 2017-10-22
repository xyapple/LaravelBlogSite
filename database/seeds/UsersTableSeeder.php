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
        //This is the seeder table
        App\User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
            'admin'=>1,

        ]);

        App\Profile::create([
            'user_id'=>$user->id,
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, est veniam non corporis sunt quas voluptates eveniet perferendis repudiandae, voluptate natus optio eius reiciendis, placeat velit nemo molestiae fugiat fuga.',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com',
            'linkedin'=>'linkedin.com',
        ]);

    }
}

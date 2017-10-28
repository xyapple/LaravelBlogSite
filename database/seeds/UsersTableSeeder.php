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
         $user = App\User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
            'admin'=>1,

        ]);

        App\Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/1.png',
            'about' => "Currently, I am a graduate student at Boston University computer information system program.  I am passionate about learning and exploring full stack web Development and Data analysis. 
I enjoy helping others and social services which I am also a licensed mental health clinician and I had five years experiences in healthcare. 
When I am not in front of the computer, you'll typically find me exploring nature, restore pieces of furniture or baking in the kitchen.",
            'github' => 'https://github.com/xyapple',
            'linkedin'=>'https://www.linkedin.com/in/yindeascentis/',
        ]);

    }
}

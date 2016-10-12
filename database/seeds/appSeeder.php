<?php

use Illuminate\Database\Seeder;
use App\Types;
use App\User;
use App\Gigs;
use App\Conversation;
use App\Messages;
use App\Teach;
use App\Enroll;

class appSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Types::truncate();
        Gigs::truncate();
        Conversation::truncate();
        Messages::truncate();
        Teach::truncate();
        Enroll::truncate();

        Types::insert([
          ['name' => 'musician'],
          ['name' => 'recruiter'],
          ['name' => 'admin']
        ]);

        User::insert([
          [
          'first_name' => 'admin',
          'last_name'  => 'admin',
          'email'      => 'admin@musecentric.com',
          'password'   => bcrypt('1234'),
          'type'       => 3,
          'confirmed'  => 1
       ]]);

      //   [
      //      'first_name' => 'waleed',
      //      'last_name'  => 'kasem',
      //      'email'      => 'waleed@music.com',
      //      'password'   => bcrypt('1234'),
      //      'type'       => 2,
      //      'confirmed'  => 1
      //   ],
      //   [

      //  ]);


      //  Gigs::insert([
      //     'user_id' => 2,
      //     'title' => 'PLAY: Scorpio Music Benefit Festival',
      //     'date'  => '21 September, 2016',
      //     'summary' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur',
      //     'requirements' => '["Selected acts will be compensated", "Acts will have a green room, dressing room, and food/drinks for the evening", "May sell merch onsite "]',
      //     'attachments' =>'["192304da9fdadee4221a2cfb9a979266.jpeg" ,"faaab86c69be10b87e18fa66d15372a6.jpeg"]',
      //     'budget' => '300',
      //     'location' => 'Los Angeles, CA, United States'
       //
      //  ],[
      //     'user_id' => 2,
      //     'title' => 'PLAY: Scorpio Music Benefit Festival',
      //     'date'  => '21 September, 2016',
      //     'summary' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur',
      //     'requirements' => '["Selected acts will be compensated", "Acts will have a green room, dressing room, and food/drinks for the evening", "May sell merch onsite "]',
      //     'attachments' =>'["192304da9fdadee4221a2cfb9a979266.jpeg" ,"faaab86c69be10b87e18fa66d15372a6.jpeg"]',
      //     'budget' => '300',
      //     'location' => 'Los Angeles, CA, United States'
       //
      //  ]);
    }
}

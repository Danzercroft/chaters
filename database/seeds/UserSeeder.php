<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Channel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $userArray = [
            0 => [
                 "name" => "A A",
                 "email" => "a@a.a"
             ],
            1 => [
                "name" => "B B",
                "email" => "b@b.b"
            ],
            2 => [
                "name" => "C C",
                "email" => "c@c.c"
            ],
            3 => [
                "name" => "D D",
                "email" => "d@d.d"
            ],
            4 => [
                "name" => "E E",
                "email" => "e@e.e"
            ],
            ];

        foreach( $userArray as $userItem ) {
            $user = new User([
                'name' => $userItem["name"],
                'email' => $userItem["email"],
                'password' => Hash::make('123456'),
            ]);
            $user->save();
    
            Avatar::create($userItem["name"])->save("storage/app/public/avatars/".$userItem["name"]."-default.jpg", 100);
            $user->details()->updateOrCreate(['user_id' => $user->id], ['avatar'=> "avatars/".$userItem["name"]."-default.jpg"]);
    
            $channel = Channel::find(1);
            $channel->users()->attach($user->id);
            $channel = Channel::find(2);
            $channel->users()->attach($user->id);
        }

    }
}

<?php

use Illuminate\Database\Seeder;
use App\users;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new users();
        $user->email = "admin";
        $user->password = bcrypt("12345678");
        $user->role = "admin";
        $user->save();

        $user = new users();
        $user->email = "ab123@oss.unist.hr";
        $user->password = bcrypt("12345678");
        $user->role = "student";
        $user->save();

        $user = new users();
        $user->email = "ba321@oss.unist.hr";
        $user->password = bcrypt("12345678");
        $user->role = "mentor";
        $user->save();
    }
}

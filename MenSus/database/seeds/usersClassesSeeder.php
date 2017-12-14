<?php

use Illuminate\Database\Seeder;
use App\classes;
use App\users;
use App\usersClasses;

class usersClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = users::where('id', 2)->first();
        $class = classes::where('id', 1)->first();

        $class->users()->attach($u1);

    }
}

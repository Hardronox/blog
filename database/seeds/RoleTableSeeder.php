<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->description  = 'User is the Administrator of this site'; // optional
        $admin->save();

        $subscriber = new Role();
        $subscriber->name         = 'subscriber';
        $subscriber->description  = 'User is allowed to watch special courses and videos'; // optional
        $subscriber->save();
    }
}

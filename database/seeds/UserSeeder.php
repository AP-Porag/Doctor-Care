<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Asraf Porag',
            'email' => 'asraf@aic.mail.com',
            'password' => bcrypt('asraf@aic.mail.com'),

        ]);
        User::create([
            'name' => 'Razaul Karim',
            'email' => 'razaulk@aic.mail.com',
            'password' => bcrypt('razaulk@aic.mail.com'),

        ]);
    }
}

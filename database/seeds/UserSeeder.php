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
        $user = User::where('email','asraf@aic.mail.com')->first();
        if (is_null($user)){
            $user = new User();
            $user->name = "Asraf Porag";
            $user->username = "asrafporag";
            $user->email = "asraf@aic.mail.com";
            $user->password = bcrypt('asraf@aic.mail.com');
            $user->save();
        }
        $user = User::where('email','razaul@aic.mail.com')->first();
        if (is_null($user)){
            $user = new User();
            $user->name = "Razaul Karim";
            $user->email = "razaul@aic.mail.com";
            $user->username = "razaulkarim";
            $user->password = bcrypt('razaul@aic.mail.com');
            $user->save();
        }
        $user = User::where('email','konika@aic.mail.com')->first();
        if (is_null($user)){
            $user = new User();
            $user->name = "konika Asraf";
            $user->username = "konikaasraf";
            $user->email = "konika@aic.mail.com";
            $user->password = bcrypt('konika@aic.mail.com');
            $user->save();
        }
        $user = User::where('email','john@aic.mail.com')->first();
        if (is_null($user)){
            $user = new User();
            $user->name = "John Doe";
            $user->username = "johndoe";
            $user->email = "john@aic.mail.com";
            $user->password = bcrypt('john@aic.mail.com');
            $user->save();
        }
        $user = User::where('email','petey@aic.mail.com')->first();
        if (is_null($user)){
            $user = new User();
            $user->name = "Petey Cruiser";
            $user->username = "peteycruiser";
            $user->email = "petey@aic.mail.com";
            $user->password = bcrypt('petey@aic.mail.com');
            $user->save();
        }
    }
}

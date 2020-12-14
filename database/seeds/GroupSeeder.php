<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Group::create([
            'name'=>'admin'
        ]);
        Group::create([
            'name'=>'role'
        ]);
        Group::create([
            'name'=>'dashboard'
        ]);
        Group::create([
            'name'=>'profile'
        ]);
        Group::create([
            'name'=>'blog'
        ]);

    }
}

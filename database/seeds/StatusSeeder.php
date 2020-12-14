<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name'=>'pending confirmation'
        ]);
        Status::create([
            'name'=>'confirmed'
        ]);
        Status::create([
            'name'=>'treated'
        ]);
        Status::create([
            'name'=>'cancelled'
        ]);
        Status::create([
            'name'=>'requested'
        ]);
    }
}

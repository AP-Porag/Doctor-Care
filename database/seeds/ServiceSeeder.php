<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name'=>'consultation'
        ]);
        Service::create([
            'name'=>'operation'
        ]);
    }
}

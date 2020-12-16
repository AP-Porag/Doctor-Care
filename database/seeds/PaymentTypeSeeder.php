<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name'=>'advance'
        ]);
        Type::create([
            'name'=>'paid'
        ]);
        Type::create([
            'name'=>'dew'
        ]);
        Type::create([
            'name'=>'free'
        ]);
    }
}

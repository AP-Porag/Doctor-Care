<?php

use App\Models\Type;
use App\Models\Method;
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
        Method::create([
            'name'=>'cash'
        ]);
        Method::create([
            'name'=>'check'
        ]);
        Method::create([
            'name'=>'card'
        ]);
    }
}

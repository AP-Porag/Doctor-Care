<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Tablet',
        ]);
        Category::create([
            'name'=>'Syrup',
        ]);
        Category::create([
            'name'=>'Pediatric Drop',
        ]);
        Category::create([
            'name'=>'Seline',
        ]);
        Category::create([
            'name'=>'Injection',
        ]);
        Category::create([
            'name'=>'Suppository',
        ]);
    }
}

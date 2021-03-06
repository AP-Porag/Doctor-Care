<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UnitSeeder::class);
    }
}

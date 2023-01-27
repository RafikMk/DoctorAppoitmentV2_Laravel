<?php

use App\Role;
use Carbon\Carbon;
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
        $now = Carbon::now()->toDateTimeString();

        Role::insert([
            ['name' => 'Doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Patient', 'created_at' => $now, 'updated_at' => $now],
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}

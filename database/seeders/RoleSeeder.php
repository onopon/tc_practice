<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->delete();
        Role::insert(
            [
                ['id' => 1, 'name' => 'Admin',     'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'name' => 'Developer', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'name' => 'Director',  'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'name' => 'Designer',  'created_at' => now(), 'updated_at' => now()]
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@utchetumal.edu.mx',
            'password' => bcrypt('pollofrito'),
            'id_rol' => 4,
        ]);
    }
}

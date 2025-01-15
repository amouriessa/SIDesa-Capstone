<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $pendudukRole = Role::create(['name' => 'penduduk']);

        // Create users
        $userAdmin = User::Create([
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('adminsidorejo2024'),
            'nama' => 'Admin 1',

        ]);

        $userPenduduk = User::Create([
            'email' => 'penduduk@gmail.com',
            'password' => Hash::make('password'),
            'nama' => 'Penduduk',
            // 'nik' => '1234567890123456',
            'no_telepon' => '081235678'
        ]);

        $userAdmin = User::find(1);
        $userPenduduk = User::find(2);

        $userPenduduk->assignRole($pendudukRole);
        $userAdmin->assignRole($adminRole);
    }
}

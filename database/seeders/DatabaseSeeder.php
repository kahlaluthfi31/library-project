<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()
            ->whereIn('email', ['superadmin@amartalib.id', 'admin@amartalib.id'])
            ->delete();

        User::query()->updateOrCreate([
            'email' => 'superadmin@perpustakaan.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('super admin 123'),
            'role' => 'super_admin',
        ]);

        User::query()->updateOrCreate([
            'email' => 'admin@perpustakaan.com',
        ], [
            'name' => 'Admin Perpustakaan',
            'password' => Hash::make('admin 123'),
            'role' => 'admin',
        ]);

        User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $this->call([
            LandingPageContentSeeder::class,
        ]);
    }
}

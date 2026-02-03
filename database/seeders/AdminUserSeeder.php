<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gls.local'],
            [
                'name' => 'GLS Owner',
                'password' => 'password123', // auto-hashed
                'is_admin' => true,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}

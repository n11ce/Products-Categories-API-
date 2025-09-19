<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run()
    {
    User::firstOrCreate([
    'email' => 'admin@example.com'
    ],[
    'name' => 'Admin',
    'password' => Hash::make('password'),
    'role' => 'admin'
    ]);
    User::firstOrCreate([
    'email' => 'user@example.com'
    ],[
    'name' => 'User',
    'password' => Hash::make('password'),
    'role' => 'user'
    ]);
    }
}
    
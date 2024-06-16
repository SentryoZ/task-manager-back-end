<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'Administrator',
            'description' => 'Has full access to all system functions, including creating and managing users, roles, and policies.',
        ]);
        User::query()->update(['role_id' => Role::first()->id]);
    }
}

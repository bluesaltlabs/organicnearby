<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Farm;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

        // Create farm permissions
        $permissions = [
            'create farms',
            'edit farms',
            'delete farms',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $farmerRole = Role::firstOrCreate(['name' => 'farmer']);

        // Assign all permissions to admin
        $adminRole->syncPermissions($permissions);
        // Assign only create/edit to farmer
        $farmerRole->syncPermissions(['create farms', 'edit farms']);

        // Create and assign roles to users
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($adminRole);

        $farmer = User::factory()->create([
            'name' => 'Farmer User',
            'email' => 'farmer@example.com',
        ]);
        $farmer->assignRole($farmerRole);

        Farm::factory(10)->create();
    }
}

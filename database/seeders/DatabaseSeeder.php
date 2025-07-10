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
            'create locations',
            'edit locations',
            'delete locations',
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
        $farmerRole->syncPermissions(['create farms', 'edit farms', 'create locations', 'edit locations']);

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

        $farms = Farm::factory(10)->create();

        // Spokane area sample locations
        $spokaneLocations = [
            [
                'address' => '123 Green Bluff Rd',
                'city' => 'Spokane',
                'state' => 'WA',
                'zip' => '99208',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.7897,
                'longitude' => -117.3506,
                'label' => 'Green Bluff Orchard',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '456 Valley Chapel Rd',
                'city' => 'Spokane Valley',
                'state' => 'WA',
                'zip' => '99037',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.6562,
                'longitude' => -117.2340,
                'label' => 'Valley Chapel Farm',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '789 Wellesley Ave',
                'city' => 'Spokane',
                'state' => 'WA',
                'zip' => '99205',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.7032,
                'longitude' => -117.4398,
                'label' => 'Wellesley Urban Farm',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '101 Liberty Lake Rd',
                'city' => 'Liberty Lake',
                'state' => 'WA',
                'zip' => '99019',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.6769,
                'longitude' => -117.0856,
                'label' => 'Liberty Lake Fields',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '202 Cheney-Spokane Rd',
                'city' => 'Cheney',
                'state' => 'WA',
                'zip' => '99004',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.4871,
                'longitude' => -117.5758,
                'label' => 'Cheney Prairie Farm',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '303 Airway Heights Blvd',
                'city' => 'Airway Heights',
                'state' => 'WA',
                'zip' => '99001',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.6444,
                'longitude' => -117.5865,
                'label' => 'Airway Heights Acres',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '404 South Hill Dr',
                'city' => 'Spokane',
                'state' => 'WA',
                'zip' => '99223',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.6149,
                'longitude' => -117.3717,
                'label' => 'South Hill Gardens',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '505 Five Mile Rd',
                'city' => 'Spokane',
                'state' => 'WA',
                'zip' => '99208',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.7401,
                'longitude' => -117.4392,
                'label' => 'Five Mile Prairie Farm',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '606 Dishman Mica Rd',
                'city' => 'Spokane Valley',
                'state' => 'WA',
                'zip' => '99206',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.6276,
                'longitude' => -117.2606,
                'label' => 'Dishman Mica Farm',
                'timezone' => 'America/Los_Angeles',
            ],
            [
                'address' => '707 Indian Trail Rd',
                'city' => 'Spokane',
                'state' => 'WA',
                'zip' => '99208',
                'county' => 'Spokane',
                'country' => 'USA',
                'latitude' => 47.7291,
                'longitude' => -117.4877,
                'label' => 'Indian Trail Ranch',
                'timezone' => 'America/Los_Angeles',
            ],
        ];

        foreach ($farms as $i => $farm) {
            $locationData = $spokaneLocations[$i % count($spokaneLocations)];
            $farm->location()->create($locationData);
        }
    }
}

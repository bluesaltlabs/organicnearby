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

        // Hard-coded sample farms
        $sampleFarms = [
            [
                'slug' => 'green-bluff-orchard',
                'name' => 'Green Bluff Orchard',
                'description' => 'A family-owned orchard offering apples, cherries, and pumpkins.',
                'phone' => '509-555-1234',
                'email' => 'info@greenbluff.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://greenbluff.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'valley-chapel-farm',
                'name' => 'Valley Chapel Farm',
                'description' => 'Organic vegetables and farm tours in Spokane Valley.',
                'phone' => '509-555-2345',
                'email' => 'contact@valleychapel.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://valleychapel.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'wellesley-urban-farm',
                'name' => 'Wellesley Urban Farm',
                'description' => 'Urban farm specializing in microgreens and salad mixes.',
                'phone' => '509-555-3456',
                'email' => 'hello@wellesleyurban.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://wellesleyurban.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'liberty-lake-fields',
                'name' => 'Liberty Lake Fields',
                'description' => 'Fresh berries and pick-your-own experiences.',
                'phone' => '509-555-4567',
                'email' => 'info@libertylakefields.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://libertylakefields.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'cheney-prairie-farm',
                'name' => 'Cheney Prairie Farm',
                'description' => 'Prairie-raised beef and free-range eggs.',
                'phone' => '509-555-5678',
                'email' => 'info@cheneyprairie.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://cheneyprairie.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'airway-heights-acres',
                'name' => 'Airway Heights Acres',
                'description' => 'CSA shares and farm events near Airway Heights.',
                'phone' => '509-555-6789',
                'email' => 'info@airwayheightsacres.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://airwayheightsacres.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'south-hill-gardens',
                'name' => 'South Hill Gardens',
                'description' => 'Flower farm and seasonal farm stand.',
                'phone' => '509-555-7890',
                'email' => 'info@southhillgardens.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://southhillgardens.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'five-mile-prairie-farm',
                'name' => 'Five Mile Prairie Farm',
                'description' => 'Family farm with a focus on sustainable practices.',
                'phone' => '509-555-8901',
                'email' => 'info@fivemileprairie.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://fivemileprairie.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'dishman-mica-farm',
                'name' => 'Dishman Mica Farm',
                'description' => 'Vegetable farm serving Spokane Valley.',
                'phone' => '509-555-9012',
                'email' => 'info@dishmanmica.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://dishmanmica.com',
                'user_id' => $farmer->id,
            ],
            [
                'slug' => 'indian-trail-ranch',
                'name' => 'Indian Trail Ranch',
                'description' => 'Horse ranch and hay sales.',
                'phone' => '509-555-0123',
                'email' => 'info@indiantrailranch.com',
                'is_approved' => true,
                'logo_url' => null,
                'website_url' => 'https://indiantrailranch.com',
                'user_id' => $farmer->id,
            ],
        ];

        // Create farms and associate with locations
        $count = min(count($sampleFarms), count($spokaneLocations));
        for ($i = 0; $i < $count; $i++) {
            $farm = \App\Models\Farm::create($sampleFarms[$i]);
            $farm->location()->create($spokaneLocations[$i]);
        }
    }
}

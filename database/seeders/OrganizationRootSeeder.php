<?php

namespace Database\Seeders;

use Database\Factories\AddressFactory;
use Database\Factories\OrganizationFactory;
use Database\Factories\UserFactory;
use Domains\Organizations\Enums\OrganizationStatus;
use Domains\Organizations\Enums\UserStatus;
use Illuminate\Database\Seeder;

class OrganizationRootSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $address = AddressFactory::new()->create([
            'street' => 'Root Street',
            'number' => '123',
            'district' => 'Root District',
            'city' => 'Root City',
            'state' => 'TS',
            'country' => 'Root Country',
            'postal_code' => '12345-678',
        ]);

        $organization = OrganizationFactory::new()->create([
            'id' => '9c416fda-efd3-469c-a42f-3f7910685fd0',
            'name' => 'Root Organization',
            'email' => 'root@root.com',
            'status' => OrganizationStatus::ACTIVE,
            'address_id' => $address->id,

            'preferences' => [
                'multiple_items_per_order' => false,
            ],

            'brand' => [
                'logoUrl' => 'https://via.placeholder.com/150',
                'bannerUrl' => 'https://via.placeholder.com/150',
            ],

            'abilities' => [
                'Dashboard', 'Orders', 'Clients', 'Settings', 'Reports',
            ],
        ]);

        $organization->phones()->create([
            'phone_number' => '(11)99999-9999',
        ]);

        $user = UserFactory::new()->create([
            'id' => '9c41ab6a-7ee2-4642-9069-542e08ddea3f',
            'name' => 'Root User',
            'email' => 'root@root.com',
            'password' => bcrypt('root'),
            'status' => UserStatus::ACTIVE,
            'organization_id' => $organization->id,
        ]);

        $user->assignRole('admin');
    }
}

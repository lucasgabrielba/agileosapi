<?php

namespace Database\Seeders;

use Database\Factories\AddressFactory;
use Database\Factories\OrganizationFactory;
use Database\Factories\UserFactory;
use Domains\Organizations\Data\Enums\OrganizationStatus;
use Domains\Organizations\Data\Enums\UserStatus;
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
            'name' => 'Root Organization',
            'email' => 'root@root.com',
            'phones' => ['(11)99999-9999'],
            'status' => OrganizationStatus::ACTIVE->value,
            'address_id' => $address->id,
        ]);

        $user = UserFactory::new()->create([
            'name' => 'Root User',
            'email' => 'root@root.com',
            'password' => bcrypt('root'),
            'status' => UserStatus::ACTIVE->value,
            'organization_id' => $organization->id,
        ]);

        $user->assignRole('admin');
    }
}

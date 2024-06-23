<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Events\Organizations\OrganizationUpdated;
use Domains\Organizations\Models\Organization;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateOrganization
{
    public static function execute(string $organizationId, array $data): void
    {
        try {
            Organization::where('id', $organizationId)->update($data);

            event(new OrganizationUpdated($organizationId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Organization not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the update: '.$e->getMessage());
        }
    }
}

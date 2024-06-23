<?php

namespace Domains\Organizations\Actions\Organizations;

use Domains\Organizations\Events\Organizations\OrganizationDeleted;
use Domains\Organizations\Models\Organization;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteOrganization
{
    public static function execute(string $organizationId): void
    {
        try {
            Organization::where('id', $organizationId)->delete();

            event(new OrganizationDeleted($organizationId));
        } catch (ModelNotFoundException $e) {
            throw new Exception('Organization not found');
        } catch (Exception $e) {
            throw new Exception('An error occurred during the delete: '.$e->getMessage());
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterModelIdInModelHasRolesAndPermissions extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE model_has_roles ALTER COLUMN model_id TYPE text USING model_id::text');
        DB::statement('ALTER TABLE model_has_roles ALTER COLUMN model_id TYPE uuid USING model_id::uuid');

        DB::statement('ALTER TABLE model_has_permissions ALTER COLUMN model_id TYPE text USING model_id::text');
        DB::statement('ALTER TABLE model_has_permissions ALTER COLUMN model_id TYPE uuid USING model_id::uuid');
    }

    public function down()
    {
        DB::statement('ALTER TABLE model_has_roles ALTER COLUMN model_id TYPE bigint USING model_id::bigint');
        DB::statement('ALTER TABLE model_has_permissions ALTER COLUMN model_id TYPE bigint USING model_id::bigint');
    }
}

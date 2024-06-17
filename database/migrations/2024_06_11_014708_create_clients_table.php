<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('email')->unique();
            $table->json('phones')->nullable();
            $table->string('document')->unique()->nullable();

            $table->uuid('organization_id');
            $table->uuid('address_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

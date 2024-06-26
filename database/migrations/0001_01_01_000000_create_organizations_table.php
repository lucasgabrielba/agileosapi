<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('address_id')->nullable();

            $table->string('name');
            $table->string('email');
            $table->string('document')->nullable();
            $table->json('preferences')->nullable();
            $table->json('brand')->nullable();
            $table->json('abilities')->nullable();
            $table->string('status');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}

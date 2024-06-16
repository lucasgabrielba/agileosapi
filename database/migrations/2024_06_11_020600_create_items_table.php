<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->string('brand')->nullable();

            $table->uuid('client_id');
            $table->uuid('organization_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}

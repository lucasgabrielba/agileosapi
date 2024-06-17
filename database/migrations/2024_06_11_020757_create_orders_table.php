<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number');
            $table->string('status');

            $table->json('items');

            $table->text('problem_description')->nullable();
            $table->text('budget_description')->nullable();
            $table->text('internal_notes')->nullable();
            $table->json('order_history')->nullable();

            $table->timestamp('closed_at')->nullable();
            $table->timestamp('estimated_date')->nullable();
            $table->timestamp('end_of_warranty_date')->nullable();

            $table->boolean('is_reentry')->default(false);
            $table->enum('priority', ['normal', 'high'])->nullable();

            $table->json('attachments')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->uuid('client_id');
            $table->uuid('user_id');
            $table->uuid('organization_id');

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

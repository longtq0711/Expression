<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resto_id');
            $table->unsignedBigInteger('user_id');
            $table->float('amount', '8', 2);
            $table->boolean('isComplete')->default(0);
            $table->json('order_details');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('resto_id');
            $table->index('isComplete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

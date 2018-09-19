<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('customer_id')->index();
            $table->unsignedInteger('shoes_id')->index();
            $table->unsignedInteger('locker_id')->nullable();
            $table->unsignedInteger('price');
            $table->string('image_path')->nullable();
            $table->string('barcode',50)->nullable();
            $table->boolean("sensitive")->default(false);
            $table->text("note")->nullable();
            $table->string('status')->default(config('order.status.progress'));
            $table->timestamp('delivery_date');
            $table->timestamps();
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

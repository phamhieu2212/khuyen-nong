<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateplanProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id')->nullable()->comment('id san pham');
            $table->unsignedInteger('plan_id')->nullable()->comment('id ke hoach');
            $table->unsignedInteger('quantity')->nullable()->comment('so luong dang ky');
            $table->unsignedInteger('unit_id')->nullable()->comment('id don vi');
            $table->date('ended_at')->nullable();
            $table->date('started_at')->nullable();


            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('plan_products', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_products');
    }
}

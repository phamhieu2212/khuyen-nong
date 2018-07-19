<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateplanProductQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_product_quantities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_production_id')->nullable()->comment('id san pham dang ky san xuat');
            $table->unsignedInteger('amount')->nullable()->comment('so luong thay doi');
            $table->text('description')->nullable();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('plan_product_quantities', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_product_quantities');
    }
}

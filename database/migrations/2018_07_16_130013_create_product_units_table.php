<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateproductUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id')->nullable()->comment('id san pham');
            $table->unsignedInteger('unit_id')->nullable()->comment('id don vi');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('product_units', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_units');
    }
}

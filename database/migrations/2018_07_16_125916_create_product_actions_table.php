<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateproductActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id')->nullable()->comment('id san pham');
            $table->unsignedInteger('action_id')->nullable()->comment('id hanh dong');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('product_actions', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_actions');
    }
}

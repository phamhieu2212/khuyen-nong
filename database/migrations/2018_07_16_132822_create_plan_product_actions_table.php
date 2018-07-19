<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateplanProductActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_product_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_production_id')->nullable()->comment('id san pham dang ky san xuat');
            $table->unsignedInteger('action_id')->nullable()->comment('id hanh dong');
            $table->unsignedInteger('amount')->nullable()->comment('so luong');
            $table->text('description')->nullable();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('plan_product_actions', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_product_actions');
    }
}

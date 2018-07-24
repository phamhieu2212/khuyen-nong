<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatehtxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('htxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('htxes', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('htxes');
    }
}

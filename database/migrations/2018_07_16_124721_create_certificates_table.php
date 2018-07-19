<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatecertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('logo_image_id')->default(0)->nullable();
            $table->unsignedBigInteger('cover_image_id')->default(0)->nullable();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('certificates', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}

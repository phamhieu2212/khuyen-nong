<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('category_id')->nullable()->comment('id danh muc san pham');
            $table->unsignedBigInteger('cover_image_id')->default(0)->nullable();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('products', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->unsignedInteger('category_id')->nullable()->comment('id danh muc san pham');
            $table->unsignedBigInteger('cover_image_id')->default(0)->nullable();
            $table->text('description')->nullable();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('drugs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}

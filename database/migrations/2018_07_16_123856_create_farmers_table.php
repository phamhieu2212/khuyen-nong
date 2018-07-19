<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatefarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->nullable()->comment('id tai khoan');
            $table->decimal('longtitude',10,7)->nullable()->comment('kinh do');
            $table->decimal('latitude',10,7)->nullable()->comment('vi do');
            $table->unsignedInteger('type')->nullable()->comment('id tai khoan');
            $table->unsignedInteger('htx_id')->nullable()->default(0)->comment('id tai khoan');


            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('farmers', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmers');
    }
}

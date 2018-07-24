<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatefarmerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->nullable()->comment('id tai khoan');
            $table->unsignedInteger('certificate_id')->nullable()->comment('id chung chi');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('farmer_certificates', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_certificates');
    }
}

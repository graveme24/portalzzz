<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMopTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mop_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('mop_id')->references('id')->on('mop_types')->onDelete('cascade');
        });
        Schema::table('student_records', function (Blueprint $table) {
            $table->foreign('mop_id')->references('id')->on('mop_types')->onDelete('cascade');
        });
        Schema::table('payment_records', function (Blueprint $table) {
            $table->foreign('mop_id')->references('id')->on('mop_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mop_types');
    }
}

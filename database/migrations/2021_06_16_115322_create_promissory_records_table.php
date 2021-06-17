<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromissoryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promissory_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('mop_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->string('statusa')->nullable();
            $table->string('promissory_file')->nullable();
            $table->timestamps();
        });
        Schema::table('student_records', function (Blueprint $table) {
            $table->foreign('promissory_id')->references('id')->on('promissory_records')->onDelete('cascade');
        });
        Schema::table('promissory_records', function (Blueprint $table) {
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
        Schema::dropIfExists('promissory_records');
    }
}

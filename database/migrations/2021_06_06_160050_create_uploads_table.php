<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('prof_id');
            $table->string('bc')->default(Qs::getDefaultUserImage());
            $table->string('formg')->default(Qs::getDefaultUserImage());
            $table->string('goodm')->default(Qs::getDefaultUserImage());
            $table->string('rm1')->default('incomplete');
            $table->string('rm2')->default('incomplete');
            $table->string('rm3')->default('incomplete');
        });
        Schema::table('uploads', function (Blueprint $table) {
            $table->foreign('prof_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}

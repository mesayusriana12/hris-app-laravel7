<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMasterOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('master_overtimes', function (Blueprint $table) {
            $table->id();
            $table->string('month', 10);
            $table->string('year', 5);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('hour');
            $table->bigInteger('payment');
            $table->enum('status',['Pending','Paid']);
            
            $table->foreign('user_id')->references('id')->on('master_users')->onUpdate('cascade')->onDelete('set null');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_overtimes');
    }
}

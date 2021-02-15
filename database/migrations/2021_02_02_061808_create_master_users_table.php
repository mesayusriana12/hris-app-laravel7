<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateMasterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->id();
            $table->string('nip',12)->unique();
            $table->string('name',100);
            $table->date('dob');
            $table->string('live_at',200);
            $table->string('phone_number',13);
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->string('email',60);
            $table->string('password',100);
            $table->string('profile_photo', 100)->default('default.jpg');
            $table->enum('employee_status',['Tetap','Kontrak']);
            $table->enum('employee_type',['Fulltime','Freelance','Magang']);
            $table->enum('status',['Aktif','Non-Aktif']);
            $table->integer('contract_duration')->nullable();
            $table->date('start_work_date');
            $table->date('end_work_date')->nullable();
            $table->integer('yearly_leave_remaining')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->timestamps();
            // $table->rememberToken();
            
            $table->foreign('division_id')->references('id')->on('master_divisions')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('position_id')->references('id')->on('master_positions')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('master_roles')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('shift_id')->references('id')->on('master_shifts')->onUpdate('cascade')->onDelete('restrict');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_users');
    }
}

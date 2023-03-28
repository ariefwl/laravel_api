<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('name');
            $table->string('fungsional')->nullable();
            $table->string('address')->nullable();
            $table->string('regency')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('nik');
            $table->integer('identity_number');
            $table->string('identity_address')->nullable();
            $table->string('identity_regency')->nullable();
            $table->string('identity_district')->nullable();
            $table->string('identity_subdistrict')->nullable();
            $table->integer('user_dept_id');
            $table->integer('company_id');
            $table->date('start_date')->nullable();
            $table->integer('user_id');
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

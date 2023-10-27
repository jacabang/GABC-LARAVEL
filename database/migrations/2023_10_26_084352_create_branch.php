<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code')->index();
            $table->string('branch_name');
            $table->date('open_at')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('address');
            $table->string('permit_no')->nullable();
            $table->bigInteger('branch_manager_id')->unsigned()->nullable();
            $table->foreign('branch_manager_id')->references('id')->on('employee');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch');
    }
}

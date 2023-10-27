<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDeleteEmployeeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `delete_employee`;
            CREATE PROCEDURE `delete_employee`(IN `employee_id` INT(20))
            BEGIN
                UPDATE employee 
                SET `deleted_at` = NOW()
                WHERE `id` = employee_id ;
            END
            ;";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUpdateEmployeeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `update_employee`;
            CREATE PROCEDURE `update_employee`(IN `first_name` varchar(191),IN `middle_name` varchar(191),IN `last_name` varchar(191),IN `image_path` varchar(191),IN `hired_at` date,IN `employee_id` INT(20))
            BEGIN
                UPDATE employee 
                SET `first_name` = first_name, 
                    `middle_name` = middle_name, 
                    `last_name` = last_name, 
                    `hired_at` = hired_at, 
                    `image_path` = image_path
                WHERE `id` = employee_id ;
            END;";

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

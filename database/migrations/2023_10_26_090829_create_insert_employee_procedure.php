<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInsertEmployeeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insert_employee`;
            CREATE PROCEDURE `insert_employee`(IN `first_name` varchar(191),IN `middle_name` varchar(191),IN `last_name` varchar(191),IN `image_path` varchar(191),IN `hired_at` date,OUT id int(11))
            BEGIN
                INSERT INTO employee (`first_name`,`middle_name`,`last_name`,`hired_at`,`image_path`) VALUES (first_name, middle_name, last_name, hired_at, image_path);
                SET id = LAST_INSERT_ID();
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

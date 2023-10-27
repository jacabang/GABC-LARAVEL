<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSearchEmployeeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `search_employee`;
            CREATE PROCEDURE `search_employee`(IN `q` varchar(191))
            BEGIN
                SELECT * FROM employee WHERE (`first_name` LIKE CONCAT('%',q,'%') OR `last_name` LIKE CONCAT('%',q,'%') OR `middle_name` LIKE CONCAT('%',q,'%')) AND deleted_at IS NULL;
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

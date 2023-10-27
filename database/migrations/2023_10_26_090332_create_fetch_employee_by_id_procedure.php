<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFetchEmployeeByIdProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `fetch_employee_by_id`;
            CREATE PROCEDURE `fetch_employee_by_id`(IN `employee_id` INT(20))
            BEGIN
                SELECT * FROM employee WHERE id = employee_id AND deleted_at IS NULL  ORDER BY id LIMIT 1;
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

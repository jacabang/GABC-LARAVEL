<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFetchBranchByIdProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `fetch_branch_by_id`;
            CREATE PROCEDURE `fetch_branch_by_id`(IN `branch_id` INT(20))
            BEGIN
                SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
                    LEFT JOIN (SELECT * FROM employee WHERE `deleted_at` IS NULL) as b ON a.branch_manager_id = b.id WHERE a.`deleted_at` IS NULL AND a.id = branch_id  ORDER BY a.id  LIMIT 1;
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

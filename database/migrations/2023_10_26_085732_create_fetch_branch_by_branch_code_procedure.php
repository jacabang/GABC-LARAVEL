<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFetchBranchByBranchCodeProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `fetch_branch_by_branch_code`;
            CREATE PROCEDURE `fetch_branch_by_branch_code`(IN `branch_code` varchar(191))
            BEGIN
                SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
                    LEFT JOIN employee b ON a.branch_manager_id = b.id WHERE a.`deleted_at` IS NULL AND a.branch_code = branch_code  ORDER BY a.id;
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFetchBranchWTrashedProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $procedure = "DROP PROCEDURE IF EXISTS `fetch_branch_w_trashed`;
            CREATE PROCEDURE `fetch_branch_w_trashed`()
            BEGIN
                SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
                    LEFT JOIN employee b ON a.branch_manager_id = b.id ORDER BY a.id;

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
        Schema::dropIfExists('fetch_branch_w_trashed_procedure');
    }
}

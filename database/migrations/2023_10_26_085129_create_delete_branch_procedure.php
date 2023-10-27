<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDeleteBranchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `delete_branch`;
            CREATE PROCEDURE `delete_branch`(IN `branch_id` INT(20))
            BEGIN
                UPDATE branch 
                SET `deleted_at` = NOW(),
                `branch_code` = CONCAT(`branch_code`, ' (DELETE)')
                WHERE `id` = branch_id ;
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

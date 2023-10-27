<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUpdateBranchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `update_branch`;
            CREATE PROCEDURE `update_branch`(IN `branch_code` varchar(191),IN `branch_name` varchar(191),IN `address` varchar(191),IN `barangay` varchar(191),IN `city` varchar(191),IN `permit_no` varchar(191),IN `open_at` date,IN `branch_manager_id` varchar(191),IN `is_active` INT(1),IN `branch_id` INT(20))
            BEGIN
                UPDATE branch 
                SET `branch_code` = branch_code, 
                    `branch_name` = branch_name, 
                    `address` = address, 
                    `barangay` = barangay,
                    `city` = city,
                    `permit_no` = permit_no,
                    `branch_manager_id` = branch_manager_id,
                    `is_active` = is_active,
                    `open_at` = open_at
                WHERE `id` = branch_id;
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

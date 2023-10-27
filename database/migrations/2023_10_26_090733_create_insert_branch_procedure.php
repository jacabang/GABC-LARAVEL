<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInsertBranchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `insert_branch`;
            CREATE PROCEDURE `insert_branch`(IN `branch_code` varchar(191),IN `branch_name` varchar(191),IN `address` varchar(191),IN `barangay` varchar(191),IN `city` varchar(191),IN `permit_no` varchar(191),IN `open_at` date,IN `branch_manager_id` varchar(191),IN `is_active` INT(1), OUT last_id int(11))
            BEGIN
                INSERT INTO branch (`branch_code`,`branch_name`,`address`,`barangay`,`city`,`permit_no`,`open_at`,`branch_manager_id`,`is_active`) VALUES (branch_code, branch_name, address, barangay, city, permit_no, open_at, branch_manager_id, is_active);
                SET last_id = LAST_INSERT_ID();
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

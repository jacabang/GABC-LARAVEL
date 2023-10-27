<?php
namespace App\Repositories;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PDO;
use Carbon\Carbon as Carbon ;

use App\Models\Branch as Branch;
use App\Models\Employee as Employee;

class GabcRepository
{
    protected $db;
    protected $timestamp = false;

    public function __construct(Connection $db)
    {
        $this->db = $db;
        date_default_timezone_set('Asia/Manila');
    }

    public static function menu(){
        $access = [];

        return view('partial.menu', compact('access'));
    }

    public static function fetchEmployee(){

        // laravel way
        // return Employee::with('branches')
        //     ->get(); 

        return Employee::fetchEmployee();

    }

    public static function fetchEmployeeViaId($id){
       // laravel way
        // return Employee::with('branches')
        //    ->where('id', $id)
        //     ->first();  

        $data = array($id);

        return Employee::fetchEmployeeViaId($data);
    }

    public static function addEmployee($data, $image_name){

        // laravel way
        // return Employee::create([
        //     'first_name' => $data['first_name'],
        //     'middle_name' => $data['middle_name'],
        //     'last_name' => $data['last_name'],
        //     'hired_at' => $data['date_hired'],
        //     'image_path' => $image_name
        // ]);

        $data = array(
            $data['first_name'],
            $data['middle_name'],
            $data['last_name'],
            $image_name,
            $data['date_hired']
        );

        return Employee::create_employee($data);
    }

    public static function updateEmployee($data, $image_name, $id){

        
        $employee = self::fetchEmployeeViaId($id);

        if($employee != ""):
        // laravel way
        //     $employee->first_name = $data['first_name'];
        //     $employee->middle_name = $data['middle_name'];
        //     $employee->last_name = $data['last_name'];
        //     $employee->hired_at = $data['date_hired'];
        //     $employee->image_path = $image_name;
        //     $employee->save();
        //     return $employee;

            $data = array(
                $data['first_name'],
                $data['middle_name'],
                $data['last_name'],
                $image_name,
                $data['date_hired'],
                $id
            );

            Employee::update_employee($data);

        endif;
    }

    public static function deleteEmployee($id){

        $data = array($id);
        
        return Employee::delete_employee($data);
    }

    public function fetchEmployeeSourceViaSearch($search){
        //laravel way

        // return Employee::whereRaw(DB::RAW("(`first_name` LIKE '%{$search}%' OR `last_name` LIKE '%{$search}%' OR `middle_name` LIKE '%{$search}%')"))
        //     ->get();

        $data = array($search);

        return Employee::fetchEmployeeSourceViaSearch($data);
    }

    public static function fetchBranchViaId($id){
       // laravel way
        // return Branch::with('branch_manager')
        //     ->selectRaw("*, id as branch_id")
        //     ->where('id', $id)
        //     ->first();

        $data = array($id);

        return Branch::fetchBranchViaId($data);
    }

    public static function fetchBranch(){

        // laravel way
        // return Branch::with('branch_manager')
        //     ->selectRaw("*, id as branch_id")
        //     ->get(); 

        return Branch::fetchBranch();
    }

    public static function addBranch($data){

        $is_active = 0;
        $branch_manager_id = NULL;

        if(isset($data['is_active'])):
            $is_active = 1;
        endif;

        if(isset($data['branch_manager_id'])):
            $branch_manager_id = $data['branch_manager_id'];
        endif;

        $check = self::fetchEmployeeViaId($branch_manager_id);

        if($check == ""):

            $branch_manager_id = NULL;

        endif;

        // laravel way
        // return Branch::create([
        //     'branch_code' =>$data['branch_code'],
        //     'branch_name' =>$data['branch_name'],
        //     'address' =>$data['address'],
        //     'barangay' =>$data['barangay'], 
        //     'city' =>$data['city'],
        //     'permit_no' =>$data['permit_no'], 
        //     'open_at' =>$data['open_at'],
        //     'branch_manager_id' =>$branch_manager_id, 
        //     'is_active' =>$is_active
        // ]);

        $data = array(
            $data['branch_code'],
            $data['branch_name'],
            $data['address'],
            $data['barangay'], 
            $data['city'],
            $data['permit_no'], 
            $data['date_open'],
            $branch_manager_id, 
            $is_active
        );

        return Branch::create_branch($data);
    }

    public static function updateBranch($data, $id){

        $branch = self::fetchBranchViaId($id);

        if($branch != ""):

            $is_active = 0;
            $branch_manager_id = NULL;

            if(isset($data['is_active'])):
                $is_active = 1;
            endif;

            if(isset($data['branch_manager_id'])):
                $branch_manager_id = $data['branch_manager_id'];
            endif;

            $check = self::fetchEmployeeViaId($branch_manager_id);

            if($check == ""):

                $branch_manager_id = NULL;

            endif;

            // laravel way
            // $branch->branch_code = $data['branch_code'];
            // $branch->branch_name = $data['branch_name'];
            // $branch->address = $data['address'];
            // $branch->barangay = $data['barangay']; 
            // $branch->city = $data['city'];
            // $branch->permit_no = $data['permit_no']; 
            // $branch->open_at = $data['date_open'];
            // $branch->branch_manager_id = $branch_manager_id;
            // $branch->is_active = $is_active;
            // $branch->save();
            // return $branch;

            $data = array(
                $data['branch_code'],
                $data['branch_name'],
                $data['address'],
                $data['barangay'], 
                $data['city'],
                $data['permit_no'], 
                $data['date_open'],
                $branch_manager_id, 
                $is_active,
                $id
            );

            Branch::update_branch($data);

        endif;
    }

    public static function deleteBranch($id){

        $data = array($id);

        return Branch::delete_branch($data);
    }


    public static function checkBranchCode($branch_code){

        // laravel way
        // return Branch::where('branch_code', $branch_code)
            // ->first();

        $data = array($branch_code);

        return Branch::checkBranchCode($data);
    }

}
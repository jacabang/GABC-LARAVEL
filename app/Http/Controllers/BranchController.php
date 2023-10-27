<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Gabc;

class BranchController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 2000);
        $this->middleware('guest'); //guest if all access

        date_default_timezone_set('Asia/Manila');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = Gabc::menu();
        $employees = Gabc::fetchEmployee();

        return view('pages.branch.list', compact('menu','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menu = Gabc::menu();

        $query = "";
        $branch_id = "";
        $branch_code = "";
        $branch_name = "";
        $open_at = "";
        $address = "";
        $barangay = "";
        $city = "";
        $permit_no = "";
        $branch_manager_id = "";
        $is_active = 1;

        $label = "Add";
        $label1 = "Create";
        $employee = "";

        return view('pages.branch.create', compact('menu','query','branch_id','branch_code','branch_name','open_at','address','barangay','city','permit_no','branch_manager_id','is_active','label','label1','employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'branch_code'=>'required|unique:branch,branch_code',
            'branch_name'=>'required',
            'address'=>'required',
            'barangay'=>'required',
            'city'=>'required',
        ]);

        Gabc::addBranch($request);

        return redirect("/branch");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $menu = Gabc::menu();
        $query = Gabc::fetchBranchViaId($id);

        if($query == ""):
            return redirect('/branch');
        endif;

        $branch_id = $id;
        $branch_code = $query->branch_code;
        $branch_name = $query->branch_name;
        $open_at = $query->open_at;
        $address = $query->address;
        $barangay = $query->barangay;
        $city = $query->city;
        $permit_no = $query->permit_no;
        $branch_manager_id = $query->branch_manager_id;
        $is_active = $query->is_active;

        $label = "Edit";
        $label1 = "Update";
        //laravel ORM
        //$employee = $query->branch_manager;
        $employee = Gabc::fetchEmployeeViaId($query->branch_manager_id);

        return view('pages.branch.create', compact('menu','query','branch_id','branch_code','branch_name','open_at','address','barangay','city','permit_no','branch_manager_id','is_active','label','label1','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
            'branch_code'=>'required|unique:branch,branch_code,'.$id,
            'branch_name'=>'required',
            'address'=>'required',
            'barangay'=>'required',
            'city'=>'required',
        ]);

        Gabc::updateBranch($request, $id);

        return redirect("/branch/".$id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //laravel way
        //$check = Gabc::fetchBranchViaId($id);

        // if($check != ""):
            // $check->delete();
            // return $check;
        // endif;

        return Gabc::deleteBranch($id);
    }

    public function fetchBranch(){
        $query = Gabc::fetchBranch();

        $data = [];

        $link = URL('/branch');

        foreach($query as $result):

            $action1 = "<a style='margin-bottom: .5em; margin-left: .5em;' class='btn btn-info btn-flat btn-pri icon-upate' href='$link/$result->branch_id/edit'><i class='fa fa-pencil-square-o'></i> Edit</a>";

            $action1 .="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result->branch_id."' class='btn btn-danger btn-flat btn-pri icon-delete'>
                        <i class='fa fa-trash'></i> Delete
                    </a>";

            $branch_manager = "";

            if($result->last_name != "" || $result->last_name != "" || $result->middle_name != ""):
                $branch_manager = $result->last_name.", ".$result->first_name." ".$result->middle_name;
            endif;

            //laravel way

            // if($result->branch_manager != ""):
            //     $branch_manager = $result->branch_manager->last_name.", ".$result->branch_manager->first_name." ".$result->branch_manager->middle_name;
            // endif;

            $data[] = array(
                $result->branch_code,
                $result->branch_name,
                $branch_manager,
                $result->open_at != "" ? date("m/d/Y", strtotime($result->open_at)) : "",
                $action1
            );

        endforeach;

        $res = array('data'=>$data);
        return  json_encode($res);
    }

    public function checkBranchCode(Request $request){
        $data = array("status"=> false);

        if($request->get('branch_code') != ""):
            $check = Gabc::checkBranchCode($request->get('branch_code'));

            if($check != ""):

                if($check->branch_id == $request->get('branch_id')):
                    
                    $data = array("status"=> false);

                else:
                    $data = array("status"=> true);
                endif;
            else:

                $data = array("status"=> false);

            endif;
        endif;

        return json_encode($data);
    }
}

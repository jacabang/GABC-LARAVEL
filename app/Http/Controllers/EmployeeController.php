<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Gabc;

class EmployeeController extends Controller
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
        $image_file = URL('/').'/assets/images/No-Image-Available.png';

        return view('pages.employee.list', compact('menu','image_file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'first_name'=>'required',
            'last_name'=>'required',
            'date_hired'=>'required',
        ]);

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $name);
        } else {
            $name = NULL;
        }

        Gabc::addEmployee($request->all(), $name);

        return redirect("/employee");
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
            'first_name'=>'required',
            'last_name'=>'required',
            'date_hired'=>'required',
        ]);

        $check = GABC::fetchEmployeeViaId($id);

        if($check != ""):

            if ($request->hasFile('banner')) {

                if($check->image_path != ""):

                    $source_file = public_path('uploads/').$check->image_path;

                    if(file_exists($source_file)):
                        unlink($source_file);
                    endif;

                endif;

                $image = $request->file('banner');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = 'uploads';
                $image->move($destinationPath, $name);

            } else {
                $name = $check->image_path;
            }

            GABC::updateEmployee($request->all(), $name, $id);

        endif;

        return redirect("/employee");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employee = Gabc::fetchEmployeeViaId($id);

        if($employee != ""):

            if($employee->image_path != ""):

                $source_file = public_path('uploads/').$employee->image_path;

                if(file_exists($source_file)):
                    unlink($source_file);
                endif;

            endif;

            // laravel way
            // $check->delete();

            return Gabc::deleteEmployee($id);
        endif;
    }

    public function fetchEmployeeSourceViaSearch(Request $request){

        $array[] = array("id" => "", "name" => "MARKED EMPTY");

        if($request->get('q') != ""):
            $query = Gabc::fetchEmployeeSourceViaSearch($request->get('q'));
        else:
            $query = Gabc::fetchEmployee();
        endif;

        foreach($query as $result):
            $array[] = array("id" => $result->id, "name" => $result->last_name.', '.$result->first_name.' '.$result->middle_name);
        endforeach;

        $data = array(
                "incomplete_results" => true, 
                "items" => $array, 
                "total_count" => COUNT($array)
            );

        return json_encode($data);

    }

    public static function fetchEmployee(){
        $query = GABC::fetchEmployee();

        $data = [];

        $image_path = URL('/').'/assets/images/No-Image-Available.png';

        foreach($query as $result):

            if($result->image_path != ""):

                $source_file = public_path('uploads/').$result->image_path;
                $image_file = URL('/uploads')."/".$result->image_path;

                if(file_exists($source_file)):
                    $image_path = $image_file;
                else:
                    $image_path = URL('/').'/assets/images/No-Image-Available.png';
                endif;
            else:
                $image_path = URL('/').'/assets/images/No-Image-Available.png';

            endif;

            $action1 ="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result->id."' data-first_name='".$result->first_name."' data-middle_name='".$result->middle_name."' data-last_name='".$result->last_name."' data-hired_at='".$result->hired_at."' data-image_path='".$image_path."' class='btn btn-info btn-flat btn-pri icon-update'>
                        <i class='fa fa-pencil-square-o'></i> Edit
                    </a>";

            $action1 .="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result->id."' class='btn btn-danger btn-flat btn-pri icon-delete'>
                        <i class='fa fa-trash'></i> Delete
                    </a>";

            $data[] = array(
                $result->first_name,
                $result->middle_name,
                $result->last_name,
                $result->hired_at,
                $action1
                );

        endforeach;

        $res = array('data'=>$data);
        return  json_encode($res);
    }
}

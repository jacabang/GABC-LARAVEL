<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'image_path',
        'hired_at'
    ];

    public function branches(){
        return $this->hasMany('App\Models\Branch', 'accountability_id', 'id');
    }

    public static function fetchEmployee(){

        return DB::select('call fetch_employee');
    }

    public static function create_employee($data){

        $query = DB::select('call insert_employee(?, ?, ?, ?, ?, @last_id)', $data);

        $query = DB::select('select @last_id as id');

        foreach($query as $result):
            $data = array($result->id);
        endforeach;

        return self::fetchEmployeeViaId($data);
    }

    public static function update_employee($data){

        DB::select('call update_employee(?, ?, ?, ?, ?, ?)', $data);

    }

    public static function delete_employee($data){


        DB::select('call delete_employee(?)', $data);

    }

    public static function fetchEmployeeViaId($data){

        $query = DB::select('call fetch_employee_by_id(?)', $data);

        foreach($query as $result):
            return $result;
        endforeach;

    }

    public static function fetchEmployeeSourceViaSearch($data){

        return DB::select('call search_employee(?)', $data);

    }
}

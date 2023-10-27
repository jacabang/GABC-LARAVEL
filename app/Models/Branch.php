<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'branch';

    protected $fillable = [
        'branch_code',
        'branch_name',
        'open_at',
        'barangay',
        'city',
        'address',
        'permit_no',
        'branch_manager_id',
        'is_active'
    ];

    public function branch_manager(){
        return $this->hasOne('App\Models\Employee', 'id', 'branch_manager_id');
    }

    public static function fetchBranchViaId($data){

        $query = DB::select('call fetch_branch_by_id(?)', $data);

        foreach($query as $result):
            return $result;
        endforeach;
    }

    public static function fetchBranch(){

        return DB::select('call fetch_branch');

    }

    public static function create_branch($data){

        $query = DB::select('call insert_branch(?, ?, ?, ?, ?, ?, ?, ?, ?, @last_id)', $data);

        $query = DB::select('select @last_id as id');

        foreach($query as $result):
            $data = array($result->id);
        endforeach;

        return self::fetchBranchViaId($data);

    }

    public static function update_branch($data){

        DB::select('call update_branch(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data);

    }

    public static function delete_branch($data){

        return DB::select('call delete_branch(?)', $data);

    }

    public static function checkBranchCode($data){

        $query = DB::select('call fetch_branch_by_branch_code(?)', $data);

        foreach($query as $result):
            return $result;
        endforeach;

    }
}

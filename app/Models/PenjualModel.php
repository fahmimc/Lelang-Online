<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenjualModel extends Model
{
    public function allData()
    {
        return DB::table('penjual')->get();
    }

    public function detailData($id)
    {
        return DB::table('penjual')->where('id', $id)->first();
    }

    public function addData($data)
    {
        DB::table('penjual')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('penjual')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('penjual')->where('id', $id)->delete();
    }
}

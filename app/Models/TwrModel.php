<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TwrModel extends Model
{
    public function allData()
    {
        return DB::table('penawaran')->get();
    }

    public function bidData($kode_barang)
    {
        return DB::table('penawaran')->where('kode_barang', $kode_barang)->first();
    }

    public function detailData($kode_barang)
    {
        return DB::table('penawaran')->where('kode_barang', $kode_barang)->first();
    }

    public function addData($data)
    {
        DB::table('penawaran')->insert($data);
    }

    public function editData($kode_barang, $data)
    {
        DB::table('penawaran')->where('kode_barang', $kode_barang)->update($data);
    }

    public function deleteData($id)
    {
        DB::table('penawaran')->where('id', $id)->delete();
    }

    //test
    //public function detail1Data($kode_barang)
    //{
    //    return DB::table('barang')->pluck('kode_barang');
    //}

    
}

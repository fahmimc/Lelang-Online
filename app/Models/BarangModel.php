<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangModel extends Model
{
    public function allData()
    {
        return DB::table('barang')->get();
    }

    public function bidData($kode_barang)
    {
        return DB::table('barang')->where('kode_barang', $kode_barang)->first();
    }

    public function detailData($kode_barang)
    {
        return DB::table('barang')->where('kode_barang', $kode_barang)->first();
    }

    public function addData($data)
    {
        DB::table('barang')->insert($data);
    }

    public function editData($kode_barang, $data)
    {
        DB::table('barang')->where('kode_barang', $kode_barang)->update($data);
    }

    public function deleteData($kode_barang)
    {
        DB::table('barang')->where('kode_barang', $kode_barang)->delete();
    }

    //test
    //public function detail1Data($kode_barang)
    //{
    //    return DB::table('barang')->pluck('kode_barang');
    //}

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwrModel;

class TwrController extends Controller
{
    
    public function __construct()
    {
        $this->TwrModel = new TwrModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'penawaran' => $this->TwrModel->allData(),
        ];
        return view('layout.v_dataPenawaran', $data);
    }

    public function bid($kode_barang)
    {
        if (!$this->TwrModel->detailData($kode_barang))
            abort(404);
        $data = [
            'penawaran' => $this->TwrModel->detailData($kode_barang),
        ];
        return view('layout.v_bidBarang', $data);
    }

    
    //public function detail($kode_barang)
    //{
    //    if (!$this->TwrController->detailData($kode_barang))
    //        abort(404);
    //    $data = [
    //        'penawaran' => $this->TwrController->detailData($kode_barang),
    //    ];
    //    return view('layout.v_detailBarang', $data);
    //}
//
    public function add()
        {
            return view('layout.v_formBid');
        }

    public function insert()
    {
        Request()->validate([
            'nama_barang' => 'required',
            'penawar' => 'required',
            'no_hp' => 'required',
            'harga_penawaran' => 'required',
        ],[
            'nama_barang.required' => 'Wajib diisi',
            'penawar.required' => 'Wajib diisi',
            'no_hp.required' => 'Wajib diisi',
            'harga_penawaran.required' => 'Wajib diisi',

        ]);

        //upload foto
        //$file = Request()->foto;
        //$fileName = Request()->kode_barang . '.' . $file->extension();
        //$file->move(public_path('foto'), $fileName);

        
        $data = [
            'nama_barang' => Request()->nama_barang,
            'penawar' => Request()->penawar,
            'no_hp' => Request()->no_hp,
            'harga_penawaran' => Request()->harga_penawaran,
        ];


        $this->TwrModel->addData($data);
        return redirect()->route('penawaran')->with('pesan', 'Tawaran berhasil Ditambahkan!');
    }

    //public function edit($id)
    //    {
    //        if (!$this->TwrController->detailData($id))
    //        abort(404);
    //        $data = [
    //            'penawaran' => $this->TwrController->detailData($id),
    //        ];
    //        return view('layout.v_formBid', $data);
    //    }
    
    //public function update($kode_barang)
    //{
    //    Request()->validate([
    //        'kode_barang' => 'required',
    //        'nama_barang' => 'required',
    //        'tgl_mulai' => 'required',
    //        'tgl_akhir' => 'required',
    //        'harga' => 'required',
    //        'deskripsi' => 'required',
    //        'foto' => 'mimes:jpg,jpeg,bmp,png|max:1024',
    //    ],[
    //        'kode_barang.required' => 'Wajib diisi',
    //        'nama_barang.required' => 'Wajib diisi',
    //        'tgl_mulai.required' => 'Wajib diisi',
    //        'tgl_akhir.required' => 'Wajib diisi',
    //        'harga.required' => 'Wajib diisi',
    //        'deskripsi.required' => 'Wajib diisi',
    //    ]);
//
    //    //jika tidak ada validasi, maka simpan
    //    if (Request()->foto <> "") {
    //        //jika ingin ganti foto
    //        //upload foto
    //        $file = Request()->foto;
    //        $fileName = Request()->kode_barang . '.' . $file->extension();
    //        $file->move(public_path('foto'), $fileName);
//
    //    
    //        $data = [
    //            'kode_barang' => Request()->kode_barang,
    //            'nama_barang' => Request()->nama_barang,
    //            'tgl_mulai' => Request()->tgl_mulai,
    //            'tgl_akhir' => Request()->tgl_akhir,
    //            'harga' => Request()->harga,
    //            'deskripsi' => Request()->deskripsi,
    //            'foto' => $fileName,
    //        ];
//
    //        $this->TwrController->editData($kode_barang, $data);
    //    } else {
    //        //jika tidak ingin ganti foto
    //        $data = [
    //            'kode_barang' => Request()->kode_barang,
    //            'nama_barang' => Request()->nama_barang,
    //            'tgl_mulai' => Request()->tgl_mulai,
    //            'tgl_akhir' => Request()->tgl_akhir,
    //            'harga' => Request()->harga,
    //            'deskripsi' => Request()->deskripsi,
    //        ];
//
    //        $this->TwrController->editData($kode_barang, $data);
    //    }
    //    
    //    return redirect()->route('penawaran')->with('pesan', 'Data berhasil Diperbarui!');
    //}
//
    public function delete($id)
    {
        //$penawaran = $this->TwrController->detailData($id);
        //if ($penawaran->foto <> "") {
        //    unlink(public_path('foto') . '/' . $penawaran->foto);
        //}
        $this->TwrModel->deleteData($id);
        return redirect()->route('penawaran')->with('pesan', 'Data Berhasil Dihapus!');
    }

    //test
    //public function detail1($kode_barang)
    //{
    //    return view('layout.v_home');
    //}

}

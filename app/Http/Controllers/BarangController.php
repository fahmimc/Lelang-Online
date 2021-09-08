<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;

class BarangController extends Controller
{
    
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'barang' => $this->BarangModel->allData(),
        ];
        return view('layout.v_data_barang', $data);
    }

    public function bid($kode_barang)
    {
        if (!$this->BarangModel->detailData($kode_barang))
            abort(404);
        $data = [
            'barang' => $this->BarangModel->detailData($kode_barang),
        ];
        return view('layout.v_bidBarang', $data);
    }

    
    public function detail($kode_barang)
    {
        if (!$this->BarangModel->detailData($kode_barang))
            abort(404);
        $data = [
            'barang' => $this->BarangModel->detailData($kode_barang),
        ];
        return view('layout.v_detailBarang', $data);
    }

    public function add()
        {
            return view('layout.v_addBarang');
        }

    public function insert()
    {
        Request()->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,bmp,png',
        ],[
            'kode_barang.required' => 'Wajib diisi',
            'nama_barang.required' => 'Wajib diisi',
            'tgl_mulai.required' => 'Wajib diisi',
            'tgl_akhir.required' => 'Wajib diisi',
            'harga.required' => 'Wajib diisi',
            'deskripsi.required' => 'Wajib diisi',
            'foto.required' => 'Wajib diisi'

        ]);

        //upload foto
        $file = Request()->foto;
        $fileName = Request()->kode_barang . '.' . $file->extension();
        $file->move(public_path('foto'), $fileName);

        
        $data = [
            'kode_barang' => Request()->kode_barang,
            'nama_barang' => Request()->nama_barang,
            'tgl_mulai' => Request()->tgl_mulai,
            'tgl_akhir' => Request()->tgl_akhir,
            'harga' => Request()->harga,
            'deskripsi' => Request()->deskripsi,
            'foto' => $fileName,
        ];


        $this->BarangModel->addData($data);
        return redirect()->route('barang')->with('pesan', 'Data berhasil Ditambahkan!');
    }

    public function edit($kode_barang)
        {
            if (!$this->BarangModel->detailData($kode_barang))
            abort(404);
            $data = [
                'barang' => $this->BarangModel->detailData($kode_barang),
            ];
            return view('layout.v_editBarang', $data);
        }
    
    public function update($kode_barang)
    {
        Request()->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto' => 'mimes:jpg,jpeg,bmp,png|max:1024',
        ],[
            'kode_barang.required' => 'Wajib diisi',
            'nama_barang.required' => 'Wajib diisi',
            'tgl_mulai.required' => 'Wajib diisi',
            'tgl_akhir.required' => 'Wajib diisi',
            'harga.required' => 'Wajib diisi',
            'deskripsi.required' => 'Wajib diisi',
        ]);

        //jika tidak ada validasi, maka simpan
        if (Request()->foto <> "") {
            //jika ingin ganti foto
            //upload foto
            $file = Request()->foto;
            $fileName = Request()->kode_barang . '.' . $file->extension();
            $file->move(public_path('foto'), $fileName);

        
            $data = [
                'kode_barang' => Request()->kode_barang,
                'nama_barang' => Request()->nama_barang,
                'tgl_mulai' => Request()->tgl_mulai,
                'tgl_akhir' => Request()->tgl_akhir,
                'harga' => Request()->harga,
                'deskripsi' => Request()->deskripsi,
                'foto' => $fileName,
            ];

            $this->BarangModel->editData($kode_barang, $data);
        } else {
            //jika tidak ingin ganti foto
            $data = [
                'kode_barang' => Request()->kode_barang,
                'nama_barang' => Request()->nama_barang,
                'tgl_mulai' => Request()->tgl_mulai,
                'tgl_akhir' => Request()->tgl_akhir,
                'harga' => Request()->harga,
                'deskripsi' => Request()->deskripsi,
            ];

            $this->BarangModel->editData($kode_barang, $data);
        }
        
        return redirect()->route('barang')->with('pesan', 'Data berhasil Diperbarui!');
    }

    public function delete($kode_barang)
    {
        $barang = $this->BarangModel->detailData($kode_barang);
        if ($barang->foto <> "") {
            unlink(public_path('foto') . '/' . $barang->foto);
        }
        $this->BarangModel->deleteData($kode_barang);
        return redirect()->route('barang')->with('pesan', 'Data Berhasil Dihapus!');
    }

    //test
    //public function detail1($kode_barang)
    //{
    //    return view('layout.v_home');
    //}

}

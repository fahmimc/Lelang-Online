<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualModel;

class PenjualController extends Controller
{
    public function __construct()
    {
        $this->PenjualModel = new PenjualModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'penjual' => $this->PenjualModel->allData(),
        ];
        return view('layout.v_data_penjual', $data);
    }

    public function detail($id)
    {
        if (!$this->PenjualModel->detailData($id))
            abort(404);
        $data = [
            'penjual' => $this->PenjualModel->detailData($id),
        ];
        return view('layout.v_detailPenjual', $data);
    }

    public function add()
        {
            return view('layout.v_addPenjual');
        }

    public function insert()
    {
        Request()->validate([
            'nama_penjual' => 'required',
            'email_penjual' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
        ],[
            'nama_penjual.required' => 'Wajib diisi',
            'email_penjual.required' => 'Wajib diisi',
            'no_telp.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
        ]);
        
        $data = [
            'nama_penjual' => Request()->nama_penjual,
            'email_penjual' => Request()->email_penjual,
            'no_telp' => Request()->no_telp,
            'password' => Request()->password,
        ];


        $this->PenjualModel->addData($data);
        return redirect()->route('penjual')->with('pesan', 'Data berhasil Ditambahkan!');
    }

    public function edit($id)
        {
            if (!$this->PenjualModel->detailData($id))
            abort(404);
            $data = [
                'penjual' => $this->PenjualModel->detailData($id),
            ];
            return view('layout.v_editPenjual', $data);
        }
    
    public function update($id)
    {
        Request()->validate([
            'nama_penjual' => 'required',
            'email_penjual' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
        ],[
            'nama_penjual.required' => 'Wajib diisi',
            'email_penjual.required' => 'Wajib diisi',
            'no_telp.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
        ]);

        //jika tidak ada validasi, maka simpan

        $data = [
            'nama_penjual' => Request()->nama_penjual,
            'email_penjual' => Request()->email_penjual,
            'no_telp' => Request()->no_telp,
            'password' => Request()->password,
            'deskripsi' => Request()->deskripsi,
        ];

        $this->PenjualModel->editData($id, $data);

        return redirect()->route('penjual')->with('pesan', 'Data berhasil Diperbarui!');
    }

    public function delete($id)
    {
        $this->PenjualModel->deleteData($id);
        return redirect()->route('penjual')->with('pesan', 'Data Berhasil Dihapus!');
    }
}

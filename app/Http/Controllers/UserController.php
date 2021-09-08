<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'users' => $this->UserModel->allData(),
        ];
        return view('layout.v_data_user', $data);
    }

    public function detail($id)
    {
        if (!$this->UserModel->detailData($id))
            abort(404);
        $data = [
            'users' => $this->UserModel->detailData($id),
        ];
        return view('layout.v_detailUser', $data);
    }

    public function add()
        {
            return view('layout.v_addUser');
        }

    public function insert()
    {
        Request()->validate([
            'name' => 'required',
            'email' => 'required',
            //'no_telp' => 'required',
            'password' => 'required',
            'level' => 'required',
        ],[
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            //'no_telp.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
            'level.required' => 'Wajib diisi',
        ]);
        
        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'password' => Request()->password,
            'level' => Request()->level,
        ];


        $this->UserModel->addData($data);
        return redirect()->route('users')->with('pesan', 'Data berhasil Ditambahkan!');
    }

    public function edit($id)
        {
            if (!$this->UserModel->detailData($id))
            abort(404);
            $data = [
                'users' => $this->UserModel->detailData($id),
            ];
            return view('layout.v_editUser', $data);
        }
    
    public function update($id)
    {
        Request()->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
        ],[
            'id.required' => 'Wajib diisi',
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'level.required' => 'Wajib diisi',
        ]);

        //jika tidak ada validasi, maka simpan

        $data = [
            'id' => Request()->id,
            'name' => Request()->name,
            'email' => Request()->email,
            'level' => Request()->level,
        ];

        $this->UserModel->editData($id, $data);

        return redirect()->route('users')->with('pesan', 'Data berhasil Diperbarui!');
    }

    public function delete($id)
    {
        $users = $this->UserModel->detailData($id);
        
        $this->UserModel->deleteData($id);
        return redirect()->route('users')->with('pesan', 'Data Berhasil Dihapus!');
    }
}

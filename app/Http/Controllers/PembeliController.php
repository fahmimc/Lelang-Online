<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembeliModel;

class PembeliController extends Controller
{
    public function __construct()
    {
        $this->PembeliModel = new PembeliModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'pembeli' => $this->PembeliModel->allData(),
        ];
        return view('layout.v_data_pembeli', $data);
    }
}

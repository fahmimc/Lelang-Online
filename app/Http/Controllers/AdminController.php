<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'admin' => $this->AdminModel->allData(),
        ];
        return view('layout.v_data_admin', $data);
    }
}

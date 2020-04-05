<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $nasabah = Karyawan::all();
        return response($nasabah, 200);
    }

    // public function inputNasabah()
    // {
    //     return view('nasabah.input');
    // }

    public function store(Request $request)
    {
        $newKaryawan = $request->validate([
            'nik'         => 'required',
            'first_name'  => 'required',
            'last_name'   => 'required'
        ]);
        Karyawan::create($newKaryawan);
        return response()->json([
            "message" => "Karyawan record created"
        ], 201);
    }

    public function detailKaryawan($id)
    {   
        $detailKary = Karyawan::find($id);
        return response($detailKary, 200);
    }
}

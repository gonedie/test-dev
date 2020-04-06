<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $nasabah = Karyawan::all();
        
        if(count($nasabah) > 0){
            $res["status"]   = 200;
            $res["messages"] = "Success";
            $res['values']   = $nasabah;
            return response($res);
        }else{
            $res["status"]   = 204;
            $res["messages"] = "Data Empty";
            return response($res);
        }
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
        $detailKary = Karyawan::where('nik', $id)->get();

        if(count($detailKary) > 0){
            $res["status"]   = 200;
            $res["messages"] = "Success";
            $res['values']   = $detailKary;
            return response($res);
        }else{
            $res["messages"] = "Data not found";
            return response($res);
        }
    }
}

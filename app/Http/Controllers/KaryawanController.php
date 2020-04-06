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
            // $res["status"]   = 200;
            // $res["messages"] = "Success";
            // $res['values']   = $nasabah;
            // return response($res);
            return response()->json([
                'status'  => 200,
                'success' => true,
                'values'  => $nasabah
            ]);
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
        $newKaryawan = $request->validate(request()->all(), [
            'nik'         => 'required',
            'first_name'  => 'required',
            'last_name'   => 'required'
        ]);

        if($newKaryawan->fails()){
            return response()->json([
                'status'    => 500,
                'success'   => false
            ]);
        }else{
            if(Karyawan::create($newKaryawan)){
                return response()->json([
                    'status'    => 200,
                    'success'   => true
                ]);
            }
        }

        // if (Karyawan::create($newKaryawan)){
        //     $res['message'] = "Success";
        //     $res['value']   = $newKaryawan;
        //     return response($res); 
        // }else{
        //     $res["message"] = "Fail Created Data";
        //     return response($res);
        // }
    }

    public function detailKaryawan($id)
    {   
        $detailKary = Karyawan::where('nik', $id)->get();

        if(count($detailKary) > 0){
            $res["status"]   = 200;
            $res["message"] = "Success";
            $res['values']   = $detailKary;
            return response($res);
        }else{
            $res["message"] = "Data not found";
            return response($res);
        }
    }
}

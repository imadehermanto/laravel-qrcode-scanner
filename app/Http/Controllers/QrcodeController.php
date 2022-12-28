<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index');
    }

    public function post(Request $request)
    {
        $data = $request->input('data');

        //proses


        //akhir proses
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}

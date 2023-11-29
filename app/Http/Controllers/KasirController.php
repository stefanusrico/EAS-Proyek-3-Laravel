<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kasir;

class KasirController extends Controller
{
    public function addKasir(Request $request)
    {
        $NIM = 221511030;

        $validator = Validator::make($request->all(), [
            'nama_kasir' => 'required',
            'nomor_telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nomor_telepon = '08' . $NIM . substr($request->input('nomor_telepon'), -3);

        $kasir = new Kasir([
            'nama_kasir' => $request->input('nama_kasir') . " " . $NIM,
            'nomor_telepon' => $nomor_telepon,
        ]);

        $kasir->save();

        return response()->json(['message' => 'Data kasir berhasil disimpan'], 201);
    }

    public function getKasir()
    {
        $kasir = Kasir::get();
        return response()->json($kasir, 200);
    }
}
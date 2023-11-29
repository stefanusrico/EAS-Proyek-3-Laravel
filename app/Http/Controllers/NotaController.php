<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Nota;
use App\Models\Tenan;
use App\Models\Kasir;

class NotaController extends Controller
{
    public function addNota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tenan' => 'required',
            'id_kasir' => 'required',
            'jumlah_belanja' => 'required',
            'diskon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $id_tenan = $request->input('id_tenan');
        $id_kasir = $request->input('id_kasir');
        $tenan = Tenan::find($id_tenan);
        $kasir = Kasir::find($id_kasir);

        if (!$kasir) {
            return response()->json(['error' => 'Kasir not found'], 404);
        }

        $jumlah_belanja = $request->input('jumlah_belanja');
        $diskon_persen = $request->input('diskon');

        $nilai_diskon = ($diskon_persen / 100) * $jumlah_belanja;

        $nota = new Nota([
            'id_tenan' => $id_tenan,
            'id_kasir' => $id_kasir,
            'nama_tenan' => $tenan->nama_tenan,
            'nama_kasir' => $kasir->nama_kasir,
            'jumlah_belanja' => $jumlah_belanja,
            'diskon' => $diskon_persen,
            'total' => $jumlah_belanja - $nilai_diskon,
        ]);

        $nota->save();

        return response()->json(['message' => 'Data nota berhasil disimpan'], 201);
    }

    public function getTenan()
    {
        $nota = Nota::get();
        return response()->json($nota, 200);
    }

}
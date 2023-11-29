<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenan;

class TenanController extends Controller
{
    public function addTenan(Request $request)
    {
        $NIM = 221511030;
        $First_Name = 'Stefanus';

        $validator = Validator::make($request->all(), [
            'nama_tenan' => 'required',
            'nomor_telepon' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nomor_telepon = '08' . $NIM . substr($request->input('nomor_telepon'), -3);

        $tenan = new Tenan([
            'nama_tenan' => $First_Name . $request->input('nama_tenan'),
            'nomor_telepon' => $nomor_telepon,
        ]);

        $tenan->save();

        return response()->json(['message' => 'Data tenan berhasil disimpan'], 201);
    }

    public function getTenan()
    {
        $tenan = Tenan::get();
        return response()->json($tenan, 200);
    }

    public function getTenanById($id)
    {
        try {
            $tenan = Tenan::findOrFail($id);
            return response()->json($tenan, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Barang not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
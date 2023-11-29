<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class BarangController extends Controller
{
    public function addBarang(Request $request)
    {
        $NIM = 221511030;

        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'stok' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $barang = new Barang([
            'nama_barang' => $request->input('nama_barang') . " " . $NIM,
            'satuan' => $request->input('satuan'),
            'harga_satuan' => $request->input('harga_satuan'),
            'stok' => $request->input('stok'),
        ]);

        $barang->save();

        return response()->json(['message' => 'Data barang berhasil disimpan'], 201);
    }

    public function getBarang()
    {

        $barang = Barang::get();

        return response()->json($barang, 200);
    }

    public function getBarangById($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            return response()->json($barang, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Barang not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateBarang(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'stok' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $barang->nama_barang = $request->input('nama_barang');
        $barang->satuan = $request->input('satuan');
        $barang->harga_satuan = $request->input('harga_satuan');
        $barang->stok = $request->input('stok');

        $barang->save();

        return response()->json(['message' => 'Data barang berhasil diperbarui'], 200);
    }

    public function deleteBarang($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Data barang berhasil dihapus'], 200);
    }

}
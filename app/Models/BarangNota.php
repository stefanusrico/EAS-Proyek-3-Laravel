<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangNota extends Model
{
    use HasFactory;
    protected $table = 'barang_nota';

    protected $fillable = ['id_barang', 'jumlah_barang', 'harga_satuan', 'jumlah'];

    public function nota()
    {
        return $this->belongsTo(Nota::class, 'id_nota');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $table = 'nota';

    protected $fillable = ['id_tenan', 'id_kasir', 'tgl_nota', 'jam_nota', 'jumlah_belanja', 'diskon', 'total'];

    public function tenan()
    {
        return $this->belongsTo(Tenan::class, 'id_tenan');
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'id_kasir');
    }

    public function barangNota()
    {
        return $this->hasMany(BarangNota::class, 'id_nota');
    }
}
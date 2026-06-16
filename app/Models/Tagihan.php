<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = ['santri_id', 'jenis_tagihan', 'jumlah', 'jatuh_tempo', 'status'];


    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'tagihan_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'santri_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'transaksi';
    protected $fillable= [
        'id_pelanggan','no_antrian','plat_nomor','merk','status','keterangan'
    ];
    //fungsi relasi transaksi(many) dan pelanggan(one)
    public function Pelanggan()
    {
        return $this->belongsTo(pelanggan::class, 'id_pelanggan');
    }
    //Fungsi Query yang terhubung ke Controller
    public function antrian(){
        return $this->where('status','menunggu')->count();
    }
    public function proses(){
        return $this->where('status','proses')->count();
    }
    public function selesai(){
        return $this->where('status','selesai')->count();
    }
    public function countTransaksi(){
        $bulan = Carbon::now();
        return $this->whereMonth('created_at',$bulan->month)->count();
    }
    public function getData(){
        return $this->with('Pelanggan')->latest()->take(5)->get();
    }
    //Fungsi Query yang terhubung ke PelangganController
    public function whereTransaksi($id){
        return $this->where('id_pelanggan',$id)->latest()->get();
    }
    //Fungsi Query yang terhubung ke TransaksiController
    public function getTransaksi(){
        return $this->with('Pelanggan')->latest()->get();
    }
    public function findTransaksi($id){
        return $this->with('Pelanggan')->find($id);
    }
    public function createTransaksi($data){
        return $this->create($data);
    }
    public function updateTransaksi($id,$data){
        return $this->find($id)->update($data);
    }
    public function deleteTransaksi($id){
        return $this->find($id)->delete();
    }
}

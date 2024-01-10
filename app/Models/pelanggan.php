<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'pelanggan';
    protected $fillable =[
        'nama','no_telp','alamat'
    ];
    //fungsi relasi ke table transaksi
    public function Transaksi()
    {
        return $this->hasMany(transaksi::class, 'id_pelanggan');
    }
    //fungsi Query yang terkoneksi ke controller
    public function countPelanggan(){
        return $this->count();
    }
    //fungsi Query yang terhubung dengan PelangganController
    public function getPelanggan(){
        return $this->latest()->get();
    }
    public function createPelanggan($data){
        return $this->create($data);
    }
    public function findPelanggan($id){
        return $this->find($id);
    }
    public function updatePelanggan($id,$data){
        return $this->find($id)->update($data);
    }
    public function deletePelanggan($id){
        return $this->find($id)->delete();
    }
}

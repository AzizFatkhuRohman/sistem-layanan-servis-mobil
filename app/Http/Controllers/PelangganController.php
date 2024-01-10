<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\pelanggan;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Validator;

class PelangganController extends Controller
{
    //Variabel pelanggan berisi object dari model pelanggan
    protected $pelanggan;
    //Variabel transaksi berisi object dari transaksi
    protected $transaksi;

    public function __construct(pelanggan $pelanggan, transaksi $transaksi)
    {
        $this->pelanggan = $pelanggan;
        $this->transaksi = $transaksi;
    }
    //Menampilkan semua data pelanggan secara DESC
    public function getPelanggan(){
        $title = 'Pelanggan';
        $data = $this->pelanggan->getPelanggan();
        return view('admin.pelanggan',compact('title','data'));
    }
    //Proses menambah data pelanggan
    public function postPelanggan(Request $request){
        $validasi = Validator::make($request->all(),[
            'nama'=>'required','no_telp'=>'required|numeric','alamat'=>'required'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'no_telp.required'=>'No telepon tidak boleh kosong',
            'no_telp.numeric'=>'No telepon harus terdiri dari angka',
            'alamat.required'=>'Alamat tidak boleh kosong'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $this->pelanggan->createPelanggan([
                'nama'=>$request->nama,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat
            ]);
            return redirect()->back()->with('postPelanggan','Tambah pelanggan berhasil');
        }
        
    }
    //Menampilkan satu data pelanggan berdasarkan id
    public function findPelanggan($id){
        $title = 'Detail Pelanggan';
        $data = $this->pelanggan->findPelanggan($id);
        $transaksi = $this->transaksi->whereTransaksi($id);
        return view('admin.pelanggan-detail',compact('title','data','transaksi'));
    }
    //Proses mengubah data pelanggan
    public function putPelanggan(Request $request, $id){
        $validasi = Validator::make($request->all(),[
            'nama'=>'required','no_telp'=>'required|numeric','alamat'=>'required'
        ],[
            'nama.required'=>'Nama tidak boleh kosong',
            'no_telp.required'=>'No telepon tidak boleh kosong',
            'no_telp.numeric'=>'No telepon harus terdiri dari angka',
            'alamat.required'=>'Alamat tidak boleh kosong'
        ]);
        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi);
        } else {
            $data =[
                'nama'=>$request->nama,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat
            ];
            $this->pelanggan->updatePelanggan($id,$data);
            return redirect()->back()->with('putPelanggan','Ubah pelanggan berhasil');
        }
    }
    //Proses hapus data pelanggan
    public function deletePelanggan($id){
        $this->deletePelanggan($id);
        return redirect()->back()->with('deletePelanggan','Hapus pelanggan berhasil');
    }
}

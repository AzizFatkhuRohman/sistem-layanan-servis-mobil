<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\pelanggan;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    //Variabel pelanggan berisi object dari model pelanggan
    protected $pelanggan;
    //Variabel transaksi berisi object dari transaksi
    protected $transaksi;

    public function __construct(pelanggan $pelanggan, transaksi $transaksi)
    {
        $this->pelanggan = $pelanggan;
        $this->transaksi = $transaksi;
    }
    //Menampilkan Dashboard
    public function getDashboard(){
        $title = 'Dashboard';
        $pelanggan = $this->pelanggan->countPelanggan();
        $antrian = $this->transaksi->antrian();
        $proses = $this->transaksi->proses();
        $selesai = $this->transaksi->selesai();
        $namabulan = Carbon::now()->format('F');
        $transaksi = $this->transaksi->countTransaksi();
        $data = $this->transaksi->getData();
        return view('admin.dashboard',compact('title','pelanggan','antrian','proses','selesai','namabulan','transaksi','data'));
    }
}

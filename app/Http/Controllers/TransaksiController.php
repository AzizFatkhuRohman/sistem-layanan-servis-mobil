<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //Variabel transaksi berisi object model transaksi
    protected $transaksi;

    public function __construct(transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }
    //Menampilkan semua data transaksi secara DESC
    public function getTransaksi(){
        $title = 'Transaksi';
        $data = $this->transaksi->getTransaksi();
        return view('admin.transaksi',compact('title','data'));
    }
}

@extends('layouts.app')
@section('main')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Selamat datang {{Auth::user()->nama}}! 🎉</h5>
                <p class="mb-4" style="font-style: italic;">
                  Semoga harimu menyenangkan.
                </p>

                <a href="{{url('profil/'.Auth::user()->id)}}" class="btn btn-sm btn-outline-primary">View Profile</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('assets/img/icons/unicons/chart-success.png')}}"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Pelanggan</span>
                <h3 class="card-title mb-2">{{$pelanggan}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('assets/img/icons/unicons/wallet-info.png')}}"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Antrian</span>
                <h3 class="card-title text-nowrap mb-1">{{$antrian}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <h5 class="card-header">Transaksi Terbaru</h5>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered border-primary table-striped text-center">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Plat Nomor</th>
                      <th scope="col">Nama pemilik</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                      <th scope="row">{{$no++}}</th>
                      <td>{{$item->plat_nomor}}</td>
                      <td>{{$item->pelanggan->nama}}</td>
                      <td>
                          <a href="{{url('transaksi/detail/'.$item->id)}}" class="btn btn-outline-primary btn-sm">
                              <i class='bx bx-bullseye'></i>
                          </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded" />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Proses</span>
                <h3 class="card-title text-nowrap mb-2">{{$proses}}</h3>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded" />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Selesai</span>
                <h3 class="card-title mb-2">{{$selesai}}</h3>
              </div>
            </div>
          </div>
          <!-- </div>
<div class="row"> -->
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Transaksi</h5>
                      <span class="badge bg-label-warning rounded-pill">{{$namabulan}}</span>
                    </div>
                    <div class="mt-sm-auto">
                      <h3 class="mb-0">{{$transaksi}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
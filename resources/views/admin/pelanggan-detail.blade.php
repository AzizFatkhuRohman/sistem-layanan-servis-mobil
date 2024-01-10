@extends('layouts.app')
@section('main')
    <div class="container mt-3">
        @if ($errors->any())
          <div class="alert alert-danger mt-3">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      @if (session('putPelanggan'))
      <script>
        Swal.fire({
        icon: 'success',
        title: 'Update',
        text: '{{session('putPelanggan')}}'
      })
        </script>
        @endif
        <div class="card mb-3">
            <div class="card-header">
              {{$title}}
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control"
                        value="{{$data->nama}}" id="nama" name="nama" readonly>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">No telepon</label>
                        <input type="number" class="form-control"
                        value="{{$data->no_telp}}" id="no_telp" name="no_telp" readonly>
                      </div>
                </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                    name="alamat" readonly>{{$data->alamat}}</textarea>
                  </div>
                  <div class="mb-3">
                    <button type="button" class="btn btn-primary"
                    id="ubahData">Ubah</button>
                    <input type="submit" value="Simpan" class="btn btn-primary" id="simpan" hidden>
                  </div>
                </form>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header">
              Transaksi
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered border-primary text-center">
                        <thead>
                            <tr>
                              <th scope="col">No antrian</th>
                              <th scope="col">Plat nomor</th>
                              <th scope="col">Status</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($transaksi as $item)
                            <tr>
                              <th scope="row">{{$item->no_antrian}}</th>
                              <td>{{$item->plat_nomor}}</td>
                              <td>
                                @if ($item->status == 'menunggu')
                                    <button class="btn btn-primary btn-sm">{{$item->status}}</button>
                                @elseif($item->status == 'proses')
                                <button class="btn btn-warning btn-sm">{{$item->status}}</button>
                                @else
                                <button class="btn btn-success btn-sm">{{$item->status}}</button>
                                @endif
                              </td>
                              <td>
                                <div class="d-flex">
                                    <a href="{{url('master/pengguna/detail/'.$item->id)}}" class="btn btn-primary btn-sm" style="margin-right:2px">
                                        <i class='bx bx-bullseye'></i>
                                    </a>
                                    <form id="form-action" action="{{url('master/pengguna/hapus/'.$item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                        onclick="hapus()"><i class='bx bxs-eraser'></i></button>
                                    </form>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                  </div>
            </div>
          </div>
    </div>
      <script>
        $(document).ready(function() {
            $("#ubahData").click(function() {
                $("#nama").prop("readonly", false);
                $("#no_telp").prop("readonly", false);
                $("#exampleFormControlTextarea1").prop("readonly", false);
                $("#simpan").removeAttr("hidden")
                $(this).hide();
            });
        });
    </script>
@endsection
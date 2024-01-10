@extends('layouts.app')
@section('main')
    <div class="container">
      @if ($errors->any())
          <div class="alert alert-danger mt-3">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      @if (session('postPelanggan'))
      <script>
        Swal.fire({
        icon: 'success',
        title: 'Create',
        text: '{{session('postPelanggan')}}'
      })
        </script>
        @endif
        @if (session('deletePelanggan'))
      <script>
        Swal.fire({
        icon: 'success',
        title: 'Delete',
        text: '{{session('deletePelanggan')}}'
      })
        </script>
        @endif
        <div class="card mt-3">
            <div class="d-flex card-header" style="justify-content: space-between;">
                <div>
                    <h5>Data Pelanggan</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered border-primary text-center">
                        <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama</th>
                              <th scope="col">No telepon</th>
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
                              <td>{{$item->nama}}</td>
                              <td>{{$item->no_telp}}</td>
                              <td>
                                <div class="d-flex">
                                    <a href="{{url('master/pelanggan/detail/'.$item->id)}}" class="btn btn-primary btn-sm" style="margin-right:2px">
                                        <i class='bx bx-bullseye'></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?phone={{$item->no_telp}}" target="blank" class="btn btn-success btn-sm" style="margin-right:2px">
                                      <i class='bx bxs-send'></i>
                                    </a>
                                    <form id="hapus-pelanggan" action="{{url('master/pelanggan/hapus/'.$item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                        onclick="pelanggan()"><i class='bx bxs-eraser'></i></button>
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
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah pelanggan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nama lengkap</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      name="nama">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">No telepon</label>
                      <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      name="no_telp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                      name="alamat"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
              </div>
            </div>
          </div>          
    </div>
    <script>
      function pelanggan() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('hapus-pelanggan').submit();
            }
        });
        
    }
    </script>
    <script>
        $('#table').DataTable();
    </script>
@endsection
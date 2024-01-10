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
      @if (session('putPengguna'))
      <script>
        Swal.fire({
        icon: 'success',
        title: 'Update',
        text: '{{session('putPengguna')}}'
      })
        </script>
        @endif
        @if (session('putPassword'))
      <script>
        Swal.fire({
        icon: 'success',
        title: 'Update',
        text: '{{session('putPassword')}}'
      })
        </script>
        @endif
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5>Detail Profil</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ubah password
                </button>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <form id="formAccountSettings" method="POST">
                    @csrf
                    @method('PUT')
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Nama</label>
                    <input
                      class="form-control"
                      type="text"
                      id="nama"
                      name="nama"
                      value="{{$data->nama}}"
                      autofocus
                      readonly
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Username</label>
                    <input class="form-control" type="text" name="username" id="username"
                    value="{{$data->username}}"
                    readonly />
                  </div>
                  <div class="mb-3">
                    <input type="button" class="btn btn-primary" id="ubahProfilBtn" value="Ubah profil">
                    <input type="submit" class="btn btn-primary" id="simpan" value="Simpan" hidden>
                  </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah password</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{url('profil/ubah-password/'.$data->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Konfirmasi password</label>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function() {
            $("#ubahProfilBtn").click(function() {
                $("#nama").prop("readonly", false);
                $("#username").prop("readonly", false);
                $("#simpan").removeAttr("hidden")
                $(this).hide();
            });
        });
    </script>
@endsection
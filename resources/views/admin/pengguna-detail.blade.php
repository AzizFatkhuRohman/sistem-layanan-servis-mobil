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
        <div class="card mb-4">
            <h5 class="card-header">
                {{$title}}
            </h5>
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
                    <input type="button" class="btn btn-primary" id="ubahProfilBtn" value="Ubah">
                    <input type="submit" class="btn btn-primary" id="simpan" value="Simpan" hidden>
                  </div>
              </form>
            </div>
            <!-- /Account -->
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
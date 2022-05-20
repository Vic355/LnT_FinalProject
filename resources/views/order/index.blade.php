@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col col-12 mb-2">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              Order Details
            </div>
            <div class="col-auto">
              <a href="/shop" class="btn btn-sm btn-danger">
                Close
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          </div>
        </div>
      </div>
    </div>
    <div class="col col-8">
      <div class="card">
        <div class="card-header">
          Form Checkout
        </div>
        <div class="card-body">
          @if(count($errors) > 0)
          @foreach($errors->all() as $error)
              <div class="alert alert-warning">{{ $error }}</div>
          @endforeach
          @endif
          @if ($message = Session::get('error'))
              <div class="alert alert-warning">
                  <p>{{ $message }}</p>
              </div>
          @endif
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <form action="{{ route('order.store') }}" method="post">
            @csrf()
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama_penerima">Receiver's Name</label>
                  <input type="text" name="nama_penerima" class="form-control" value={{old('nama_penerima') }}>
                </div>
                <div class="form-group">
                  <label for="alamat">Address</label>
                  <input type="text" name="alamat" class="form-control" value={{old('alamat') }}>
                </div>
                <div class="form-group">
                  <label for="no_tlp">Active Phone Number</label>
                  <input type="text" name="no_tlp" class="form-control" value={{old('no_tlp') }}>
                </div>
                <div class="form-group">
                  <label for="provinsi">Province</label>
                  <input type="text" name="provinsi" class="form-control" value={{old('provinsi') }}>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="kota">Town</label>
                  <input type="text" name="kota" class="form-control" value={{old('kota') }}>
                </div>
                <div class="form-group">
                  <label for="kecamatan">Area</label>
                  <input type="text" name="kecamatan" class="form-control" value={{old('kecamatan') }}>
                </div>
                <div class="form-group">
                  <label for="kelurahan">RT/RW</label>
                  <input type="text" name="kelurahan" class="form-control" value={{old('kelurahan') }}>
                </div>
                <div class="form-group">
                  <label for="kodepos">Post Code</label>
                  <input type="text" name="kodepos" class="form-control" value={{old('kodepos') }}>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
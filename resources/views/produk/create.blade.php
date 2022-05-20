@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col col-lg-6 col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Product Form</h3>
          <div class="card-tools">
            <a href="/product" class="btn btn-sm btn-danger">
              Close
            </a>
          </div>
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
          <form action="/product/proses"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="kategori_id">Product Category</label>
              <select name="kategori_id" id="kategori_id" class="form-control">
                <option value="">Choose</option>
                @foreach($itemkategori as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="kode_produk">Product Code</label>
              <input type="text" name="kode_produk" id="kode_produk" class="form-control">
            </div>
            <div class="form-group">
              <label for="nama_produk">Product Name</label>
              <input type="text" name="nama_produk" id="nama_produk" class="form-control">
            </div>
            <div class="form-group">
              <label for="slug_produk">Product Tag</label>
              <input type="text" name="slug_produk" id="slug_produk" class="form-control">
            </div>
            <div class="form-group">
              <label for="deskripsi_produk">Description</label>
              <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
            <label for="foto">Picture</label>
            <input type="file" name="foto" id="foto" class="form-control">
			</div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="qty">Quantity</label>
                  <input type="text" name="qty" id="qty" class="form-control">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="satuan">Unit of Measurement</label>
                  <input type="text" name="satuan" id="satuan" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Price</label>
              <input type="text" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-warning">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
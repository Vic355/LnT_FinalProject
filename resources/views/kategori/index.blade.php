@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <!-- table kategori -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Kategori Produk</h4>
          <div class="card-tools">
            <a href="/createCat" class="btn btn-sm btn-primary">
              New
            </a>
          </div>
        </div>
        <div class="card-body">
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
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="50px">No</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Jumlah Produk</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($itemkategori as $kategori)
                <tr>
                  <td>
                  {{ ++$no }}
                  </td>
                  <td>
                  {{ $kategori->kode_kategori }}
                  </td>
                  <td>
                  {{ $kategori->nama_kategori }}
                  </td>
                  @if(empty($kategori->produk)==true)
                  <td>
                  0 produk
                  </td>
                  @else
                  <td>
                  {{ count($kategori->produk) }} Produk
                  </td>
                  @endif
                  <td>
                  {{ $kategori->status }}
                  </td>
                  <td>
                    <a href="/kategori/{{$kategori->id}}" class="btn btn-sm btn-primary mr-2 mb-2">
                      Edit
                    </a>
                    <form action="/kategori/erase/{{$kategori->id}}" method="post" style="display:inline;">
                      @csrf
                      {{ method_field('delete') }}
                      <button type="submit" class="btn btn-sm btn-danger mb-2">
                        Hapus
                      </button>                    
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <!-- untuk menampilkan link page, tambahkan skrip di bawah ini -->
            {{ $itemkategori->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
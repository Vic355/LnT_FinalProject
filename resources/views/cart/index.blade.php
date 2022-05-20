@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-8">
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
      <div class="card">
        <div class="card-header">
          Item
        </div>
        <div class="card-body">
          <table class="table table-stripped">
            <thead>
              <tr>
                <th>No</th>
                <th>Product</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($itemcart->detail as $detail)
              <tr>
                <td>
                {{ $no++ }}
                </td>
                <td>
                {{ $detail->produk->nama_produk }}
                <br />
                {{ $detail->produk->kode_produk }}
                </td>
                <td>
                {{ number_format($detail->harga, 2) }}
                </td>
                <td>
                {{ number_format($detail->diskon, 2) }}
                </td>
                <td>
                  <div class="btn-group" role="group">
                    <form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
                    @method('patch')
                    @csrf()
                      <input type="hidden" name="param" value="kurang">
                      <button class="btn btn-primary btn-sm">
                      -
                      </button>
                    </form>
                    <button class="btn btn-outline-primary btn-sm" disabled="true">
                    {{ number_format($detail->qty, 2) }}
                    </button>
                    <form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
                    @method('patch')
                    @csrf()
                      <input type="hidden" name="param" value="tambah">
                      <button class="btn btn-primary btn-sm">
                      +
                      </button>
                    </form>
                  </div>
                </td>
                <td>
                {{ number_format($detail->subtotal, 2) }}
                </td>
                <td>
                <form action="{{ route('cartdetail.destroy', $detail->id) }}" method="post" style="display:inline;">
                  @csrf
                  {{ method_field('delete') }}
                  <button type="submit" class="btn btn-sm btn-danger mb-2">
                    Erase
                  </button>                    
                </form>
                <td>
              <form action="{{ route('cart.confirm', $detail->id) }}" method="POST">
              {{ csrf_field() }}
					@method('PATCH')
              <input type="hidden" name="cart_detail_id" value={{$detail->id}}>
              <button class="btn btn-block btn-primary" type="submit">
              <i class="fa fa-shopping-cart"></i> Confirm
              </button>
            </form>
            </td>
              </tr>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col col-md-4">
      <div class="card">
        <div class="card-header">
          Summary
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <td>No Invoice</td>
              <td class="text-right">
                {{ $itemcart->no_invoice }}
              </td>
            </tr>
            <tr>
              <td>Subtotal</td>
              <td class="text-right">
                {{ number_format($itemcart->subtotal, 2) }}
              </td>
            </tr>
            <tr>
              <td>Discount</td>
              <td class="text-right">
                {{ number_format($itemcart->diskon, 2) }}
              </td>
            </tr>
            <tr>
              <td>Total</td>
              <td class="text-right">
                {{ number_format($itemcart->total, 2) }}
              </td>
            </tr>
          </table>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col">
            <a href="/order" class="btn btn-sm btn-danger">Checkout</a>
            </div>
            <div class="col">
              <form action="{{ url('emptycart').'/'.$itemcart->id }}" method="post">
                @method('patch')
                @csrf()
                <button type="submit" class="btn btn-danger btn-block">Empty Cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
<body style="overflow-x: hidden" >
<?php
$a = $itemproduk->total();
if($a == 0) {
$t = 0;
}
else{
$t = $itemproduk->total() % $itemproduk->perPage();

if ($t == 0) {
	$t = 12;
}}
?>

	<div class="row">
		<div class="container" >
		<div
  class="bg-image"
  style="
    background-image: url('https://wallpaperaccess.com/full/2959068.jpg');
    height: 400px;
  "
>
<div class="text-center">
				<br></br>
			<h2 class="text-light display-2">Search for Products</h2>
			<br></br>
			<form action="#" method="GET">
	<input type="text" name="find" placeholder="Search Product by...." value="{{ old('find') }}">
	<input type="submit" value="Search">
</form>
</div>
</div>
			<div class="col-lg-8 mx-auto my-5">	
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
				@endif
				<h4 class="my-5">Collection of Products</h4>
				<div class=container>
  <div class="alert alert-warning alert-dismissable">
  <div class="row">
    <div class="col-md-6"><strong>Showing {{$t}} Products From a Total of {{ $itemproduk->total() }} Books </strong></div>
    <div class="col-md-6 text-end">  <a href="#" class="text-decoration-none" data-dismiss="alert" >X</a>	</div>
  </div>    	  
</div>
</div>

<div class="row">
 @foreach ($itemproduk as $produk)
  <!-- col-md-2  -->
    <div class="col-md-4 mt-4">
      <div class="card">
        <div class="card-body">
		<p>"{{$produk->nama_produk}}"</p>
           <img src="{{ url('/data_file/'.$produk->foto) }}" img width="150px" class="img-responsive" alt="...">
		   <?php
		   if ($produk->qty<0){
			$q = "Out of Stock";
		   }
			   else{
				$q = $produk->qty;

			   }

		   ?>
		   <p class="card-text">Quantity : {{$q}} {{$produk->satuan}}</p>
		   <p class="card-text">Price : {{$produk->harga}}</p>
		   <p class="card-text">Code : {{$produk->kode_produk}}</p>  
		   <form action="{{ route('cartdetail.store') }}" method="POST">
              @csrf
              <input type="hidden" name="produk_id" value={{$produk->id}}>
              <button class="btn btn-block btn-primary" type="submit">
              <i class="fa fa-shopping-cart"></i> Add to Cart
              </button>
            </form>
        </div>
      </div>
    </div>
</div>
    <!-- col-md-2 end -->
 @endforeach
</div>
  </div>
</div>
			</div>
		</div>
	{{ $itemproduk->links('pagination::bootstrap-4') }}
	Page {{ $itemproduk->currentPage() }}<br/>
</body>
</html>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use File;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemproduk = DB::table('produks')->paginate(20);
        $data = array('title' => 'Produks',
                    'itemproduk' => $itemproduk);
        return view('produk.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }

    public function viewcreate()
    {
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Produk Baru',
                    'itemkategori' => $itemkategori);
        return view('produk.create', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {
        $this->validate($request, [
            'kode_produk' => 'required|unique:produks',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $foto= $request->file('foto');
 
		$nama_file = time()."_".$foto->getClientOriginalName();

		$tujuan_upload = 'data_file';
		$foto->move($tujuan_upload,$nama_file);

        $itemuser = $request->user();
        $itemuser = $request->user();
        $slug = \Str::slug($request->slug_produk);
        $inputan = $request->all();
        $inputan['slug_produk'] = $slug;
        $inputan['user_id'] = $itemuser->id;
        $inputan['status'] = 'publish';
        $inputan['foto'] = $nama_file;
        $itemproduk = Produk::create($inputan);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    public function update(Request $request,$id, Produk $itemproduk)
    {
        $this->validate($request, [
            'kode_produk' => 'required|unique:produks,id,'.$id,
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $itemproduk = Produk::find($id);
        if($request->foto != ''){       
            $path = public_path().'/data_file/';
            $npath = 'data_file';  
            //code for remove old file
            if($itemproduk->foto != ''  && $itemproduk->foto != null){
                 $file_old = $path.$itemproduk->foto;
                 unlink($file_old);
            }
  
            $foto= $request->file('foto');
 
            $nama_file = time()."_".$foto->getClientOriginalName();
            $foto->move($npath, $nama_file);
  ;
        $slug = \Str::slug($request->slug_produk);
        $validasislug = Produk::where('id', '!=', $id)
                                ->where('slug_produk', $slug)
                                ->first();
        if ($validasislug) {
            return back()->with('error', 'Slug sudah ada, coba yang lain');
        } else {
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $inputan['foto'] = $nama_file;
            $itemproduk->update($inputan);
            return redirect()->route('produk.index')->with('success', 'Data berhasil diupdate');
        }
    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewupdate($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Edit Produk',
                'itemproduk' => $itemproduk,
                'itemkategori' => $itemkategori);
        return view('produk.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $product = Produk::where('id',$id)->first();
        File::delete('data_file/'.$product->file);
     

        Produk::where('id',$id)->delete();
     
        return redirect()->back();
    }
    public function find(Request $request)
	{
		$find = $request->find;
		$product = DB::table('produks')
		->where('nama_produk','like',"%".$find."%")
		->paginate();
 
		return view('product.index',['produks' => $produk]);
 
}
public function find2(Request $request)
{
    $find = $request->find;
    $itemproduk = DB::table('produks')    
    ->where('nama_produk','like',"%".$find."%")
    ->paginate(20);
    $data = array('title' => 'Produks',
                'itemproduk' => $itemproduk);
    return view('shop', $data)->with('no', ($request->input('page', 1) - 1) * 20);

}
}
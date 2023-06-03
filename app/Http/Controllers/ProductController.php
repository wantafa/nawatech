<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Alert;

class ProductController extends Controller
{
    public function dataJson()
    {
        return DataTables::of(Product::orderByDesc('id')->get())
            ->addColumn('action', function ($row) {

                $action = '<a href="javascript:void(0);" class="btn btn-md btn-edit" data-id="' . $row->id . '" data-kd_motor="' . $row->kd_motor . '" data-jenis="' . $row->jenis . '" data-merek="' . $row->merek . '" data-cc="' . $row->cc . '" data-harga="' . $row->harga . '" data-stok="' . $row->stok . '"><i class="bx bxs-edit"></i></a> 

                <a href="javascript:void(0);" data-id="' . $row->id . '" data-id="' . $row->id . '" data-kd_motor="' . $row->kd_motor . '" data-jenis="' . $row->jenis . '" data-merek="' . $row->merek . '" data-cc="' . $row->cc . '" data-harga="' . $row->harga . '" data-stok="' . $row->stok . '" data-foto="' . $row->foto . '" class="btn btn-detail btn-md"><i class="bx bxs-show"></i></a>

                <a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-md btn-delete"><i class="bx bxs-trash"></i></a>';
                return $action;
            })
            ->addIndexColumn()
            ->make(true);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {

            Alert::error('Maaf..', 'Anda dilarang masuk ke menu ini.');
            return redirect()->to('/my_order');
        }
        
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_motor' => 'required',
            'jenis' => 'required',
            'merek' => 'required',
            'cc' => 'required',
        ]);

        $req_form = $request->all();

        if ($request->id) {

            $product = Product::find($request->id);

            $foto = $product->foto;

        if ($request->hasFile('foto')) {
            File::delete($product->foto);
            
            $foto = 'uploads/images/motor/'. time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move('uploads/images/motor', $foto);

        }
            $req_form['foto'] = $foto;

            $product->update($req_form);
            $message = "Data Product Berhasil diupdate";

        } else {
            
            if ($request->hasFile('foto')) {
                $foto = 'uploads/images/motor/'. time() . '_' . $request->file('foto')->getClientOriginalName(); 
                $request->file('foto')->move('uploads/images/motor', $foto);
                
                $req_form['foto'] = $foto;
            }

            $product = Product::create($req_form);
            $message = "Data Product Berhasil Disimpan";

        }

        return back()->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back();
    }
}

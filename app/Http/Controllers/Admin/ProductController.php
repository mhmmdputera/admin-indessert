<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $products = Product::latest()->when(request()->q, function($products) {
            $products = $products->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.product.index', compact('products'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
       $request->validate([
           'image'          => 'required|image|mimes:jpeg,jpg,png|max:2000',
           'title'          => 'required|unique:products',
           'category_id'    => 'required',
           'content'        => 'required',
           'weight'         => 'required',
           'price'          => 'required',
           'discount'       => 'required',
           'stock'          => 'required|integer',
           'bahan'          => 'required',
           'status'         => 'required|in:open,tutup',
       ]); 

       //upload image
       $image = $request->file('image');
       $image->storeAs('public/products', $image->hashName());

       //save to DB
       $product = Product::create([
           'image'          => $image->hashName(),
           'title'          => $request->title,
           'slug'           => Str::slug($request->title, '-'),
           'category_id'    => $request->category_id,
           'content'        => $request->content,
           'weight'         => $request->weight,
           'price'          => $request->price,
           'discount'       => $request->discount,
           'stock'          => $request->stock,
           'keywords'       => $request->keywords,
           'description'    => $request->description,
           'bahan'          => $request->bahan,
           'status'         => $request->status
       ]);

       if($product){
            //redirect dengan pesan sukses
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.product.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $product
     * @return void
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
       $request->validate([
           'title'          => 'required|unique:products,title,'.$product->id,
           'category_id'    => 'required',
           'content'        => 'required',
           'weight'         => 'required',
           'price'          => 'required',
           'discount'       => 'required',
           'bahan'          => 'required',
           'stock'          => 'required|integer',
           'status'         => 'required|in:open,tutup',
           'image'          => 'sometimes|image|mimes:jpeg,jpg,png|max:2000',
       ]); 

       //cek jika image kosong
       if($request->file('image') == '') {

            //update tanpa image
            $product = Product::findOrFail($product->id);
            $product->update([
                'title'          => $request->title,
                'slug'           => Str::slug($request->title, '-'),
                'category_id'    => $request->category_id,
                'content'        => $request->content,
                'weight'         => $request->weight,
                'price'          => $request->price,
                'discount'       => $request->discount,
                'stock'          => $request->stock,
                'keywords'       => $request->keywords,
                'description'    => $request->description,
                'bahan'          => $request->bahan,
                'status'         => $request->status
            ]);

       } else {

            //hapus image lama
            Storage::disk('local')->delete('public/products/'.basename($product->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //update dengan image
            $product = Product::findOrFail($product->id);
            $product->update([
                'image'          => $image->hashName(),
                'title'          => $request->title,
                'slug'           => Str::slug($request->title, '-'),
                'category_id'    => $request->category_id,
                'content'        => $request->content,
                'weight'         => $request->weight,
                'price'          => $request->price,
                'discount'       => $request->discount,
                'stock'          => $request->stock,
                'keywords'       => $request->keywords,
                'description'    => $request->description,
                'bahan'          => $request->bahan,
                'status'         => $request->status
            ]);
       }

       if($product){
            //redirect dengan pesan sukses
            return redirect()->route('admin.product.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = Storage::disk('local')->delete('public/products/'.basename($product->image));
        $product->delete();

        if($product){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
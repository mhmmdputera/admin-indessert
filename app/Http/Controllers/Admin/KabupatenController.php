<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten;


class KabupatenController extends Controller
{
    // Menampilkan semua data kabupaten
    public function index()
    {
        $kabupatens = Kabupaten::latest()->when(request()->q, function($kabupatens) {
            $kabupatens = $kabupatens->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.kabupaten.index', compact('kabupatens'));
    }

    // Menampilkan form untuk menambahkan data kabupaten
    public function create()
    {
        return view('admin.kabupaten.create');
    }

    // Menyimpan data kabupaten baru
    public function store(Request $request)
    {
        $request->validate([
            
            'name' => 'required|unique:kabupatens',
        ]);

        //save to DB
       $kabupaten = Kabupaten::create([
        
        'name'   => $request->name,
        
        ]);

        if($kabupaten){
            //redirect dengan pesan sukses
            return redirect()->route('admin.kabupaten.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.kabupaten.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    // Menampilkan form untuk mengedit data kabupaten
    public function edit(Kabupaten $kabupaten)
    {
        return view('admin.kabupaten.edit', compact('kabupaten'));
    }

    // Menyimpan perubahan pada data kabupaten
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            
            'name' => 'required|unique:kabupatens,name,'.$kabupaten->id 
        ]);

        //update data tanpa image
        $kabupaten = Kabupaten::findOrFail($kabupaten->id);
        $kabupaten->update([
            'name'   => $request->name
        ]);

        if($kabupaten){
            //redirect dengan pesan sukses
            return redirect()->route('admin.kabupaten.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.kabupaten.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    // Menghapus data kabupaten
    public function destroy($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        if ($kabupaten) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}

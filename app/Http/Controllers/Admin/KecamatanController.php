<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

class KecamatanController extends Controller
{
     /**
     * Menampilkan daftar kecamatan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatans = Kecamatan::latest()->paginate(10);
        return view('admin.kecamatan.index', compact('kecamatans'));
    }

    /**
     * Menampilkan formulir untuk membuat kecamatan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kabupatens = Kabupaten::latest()->get();
        return view('admin.kecamatan.create',compact('kabupatens') );
    }

    /**
     * Menyimpan kecamatan yang baru dibuat ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:kecamatans',
            'ongkir' => 'required',
            'kabupaten_id' => 'required',
        ]);

        $kecamatan = Kecamatan::create([
            'title' => $request->title,
            'ongkir' => $request->ongkir,
            'kabupaten_id' => $request->kabupaten_id
        ]);

        if($kecamatan){
            //redirect dengan pesan sukses
            return redirect()->route('admin.kecamatan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.kecamatan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Menampilkan formulir untuk mengedit kecamatan.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        $kabupatens = Kabupaten::latest()->get();
        return view('admin.kecamatan.edit', compact('kecamatan', 'kabupatens'));
    }

    /**
     * Memperbarui kecamatan yang ditentukan di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'title' => 'required|unique:kecamatans,title,' . $kecamatan->id,
            'ongkir' => 'required|numeric',
            'kabupaten_id' => 'required',
        ]);

        $kecamatan->update($request->all());

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diperbarui.');
    }

    /**
     * Menghapus kecamatan yang ditentukan dari database.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        if($kecamatan){
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

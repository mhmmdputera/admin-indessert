<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $request->kabupaten_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Kecamatans By Kabupaten',
            'kecamatans'    => $kecamatans
        ]);
    }
    
    /**
     * show
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        $kecamatan = Kecamatan::find($id);

        if ($kecamatan) {
            // Tambahan: Ambil data ongkir dari kecamatan jika ada
            $ongkir = $kecamatan->ongkir ?? 0;

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Kecamatan',
                'kecamatan' => [
                    'id' => $kecamatan->id,
                    'title' => $kecamatan->title,
                    'ongkir' => $ongkir, // Tambah field ongkir ke dalam respons API
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Kecamatan Tidak Ditemukan',
            ], 404);
        }
    }
}

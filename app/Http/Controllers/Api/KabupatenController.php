<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $kabupatens = Kabupaten::latest()->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Kabupaten',
            'kabupatens'    => $kabupatens
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
        $kabupaten = Kabupaten::find($id);

        if($kabupaten) {

            return response()->json([
                'success' => true,
                'message' => 'Detail Kabupaten: '. $kabupaten->name,
                'kabupaten' => $kabupaten->kecamatans()->latest()->get()
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Data Kabupaten Tidak Ditemukan',
            ], 404);

        }
    }
    
    /**
     * kabupatenHeader
     *
     * @return void
     */
    public function kabupatenHeader()
    {
        $kabupatens = Kabupaten::latest()->take(5)->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Kabupaten Header',
            'kabupatens'    => $kabupatens
        ]);
    }

    /**
     * getKecamatansByKabupatenId
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKecamatansByKabupatenId($id)
    {
        $kabupaten = Kabupaten::find($id);

        if($kabupaten) {
            $kecamatans = $kabupaten->kecamatans()->latest()->get();
            return response()->json([
                'success' => true,
                'message' => 'List Kecamatan for Kabupaten: '. $kabupaten->name,
                'kecamatans' => $kecamatans
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Kabupaten Tidak Ditemukan',
            ], 404);
        }
    }
}

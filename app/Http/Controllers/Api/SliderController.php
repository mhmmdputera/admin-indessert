<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Sliders',
            'sliders'   => $sliders
        ]);
    }
}
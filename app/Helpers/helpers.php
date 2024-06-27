<?php

if (! function_exists('moneyFormat')) {    
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return void
     */
    function moneyFormat($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}

if (! function_exists('dateID')) {         
    /**
     * dateID
     *
     * @param  mixed $tanggal
     * @return void
     */
    function dateID($tanggal) {
        $value = Carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('l, d F Y');
    }
}

if (! function_exists('witaID')) {         
    /**
     * dateID
     *
     * @param  mixed $tanggal
     * @return void
     */
    function witaID() {
        $value = Carbon\Carbon::now('Asia/Makassar');
        $parse = $value->locale('id');
        return $parse->translatedFormat('d F Y H:i:s');
    }
}
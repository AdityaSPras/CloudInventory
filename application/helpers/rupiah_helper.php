<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('rupiah')) {

    function rupiah($angka)
    {
        $rupiah = number_format($angka, 0, ',', '.');
        $hasil = "Rp. " . $rupiah;
        return $hasil;
    }
}

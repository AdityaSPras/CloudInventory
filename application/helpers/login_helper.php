<?php
defined('BASEPATH') or exit('No direct script access allowed');

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('Email')) {
        redirect('auth/login');
    }
}

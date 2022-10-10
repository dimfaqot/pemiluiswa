<?php

namespace App\Controllers;

class Vote extends BaseController
{
    function __construct()
    {
        $session = session('id');
        if (!$session) {
            if (session('role') !== 'Kpu' && session('role') !== 'Super Admin') {
                session()->setFlashdata('gagal', 'Anda belum login!.');
                header("Location: " . base_url() . '/login');
                die;
            }
        }
    }
    public function index()
    {
        helper('functions');
        $upstain = kategori(session('gender'), 'Upstain');
        $hak = true;

        if (in_array(session('username'), $upstain['data'])) {
            $hak = false;
        }

        $data = [
            'judul' => 'Vote',
            'upstain' => $hak,
            'data' => voteusername()
        ];
        return view('vote', $data);
    }
}

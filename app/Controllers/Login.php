<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Login'
        ];
        return view('login', $data);
    }

    public function auth()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($username == "" || $password == "") {
            session()->setFlashdata('gagal', "Gagal!. Username dan password harus diisi!");
            return redirect()->to(base_url('login'));
        }

        $user = \App\Models\Users::class;
        $user = new $user;

        // cek password sekarang
        $q = $user->where('username', $username)->first();
        if (!$q) {
            session()->setFlashdata('gagal', "Gagal!. Username tidak ditemukan!");
            return redirect()->to(base_url('login'));
        } else {
            if (!password_verify($password, $q['password'])) {
                session()->setFlashdata('gagal', "Gagal!. Password salah!");
                return redirect()->to(base_url('login'));
            } else {
                $r = $user->join('role', 'role_id=role.id')->where('username', $username)->first();
                session()->set([
                    'id' => $q['id'],
                    'nama' => $q['nama'],
                    'username' => $q['username'],
                    'role_id' => $q['role_id'],
                    'role' => $r['role']
                ]);
                if ($r['role'] == 'Kpu' || $r['role'] == "Super Admin") {
                    return redirect()->to(base_url("dashboard"));
                } else {
                    return redirect()->to(base_url("vote"));
                }
            }
        }
    }


    public function logout()
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('nama');
        session()->remove('role');
        session()->remove('alias');
        session()->remove('image');

        return redirect()->to(base_url());
    }
}

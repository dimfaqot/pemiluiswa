<?php

namespace App\Controllers;

class Dashboard extends BaseController
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
        $mod = \App\Models\Users::class;
        $mod = new $mod;
        $kategoril = kategori('L');
        $kategorip = kategori('P');
        $data = [
            'judul' => 'Dashboard',
            'kategoril' => $kategoril,
            'kategorip' => $kategorip
        ];
        return view('dashboard', $data);
    }
    public function kategori()
    {
        helper('functions');
        $mod = \App\Models\Capres::class;
        $mod = new $mod;

        $kategoril = kategori('L');
        $kategorip = kategori('P');
        $data = [
            'judul' => 'Kategori Pemilih',
            'kategori' => [
                'putra' => $kategoril,
                'putri' => $kategorip,
            ]
        ];
        return view('kategori', $data);
    }

    public function updatekategori()
    {
        helper('functions');
        $mod = \App\Models\Capres::class;
        $mod = new $mod;
        $order = $this->request->getVar('order');

        if ($order == 'tambahkategori') {
            $kategori = $this->request->getVar('kategori');
            if ($kategori == '') {
                session()->setFlashdata('gagal', 'Gagal!. Masukkan kategori.');
                return redirect()->to(base_url('dashboard') . '/kategori');
            }
            $pondok = $this->request->getVar('pondok');

            $q = $mod->where('tahun', date('Y'))->where('pondok', $pondok)->orderBy('id', 'ASC')->first();
            if (!$q) {
                session()->setFlashdata('gagal', 'Gagal!. Capres/cawapres belum diinput.');
                return redirect()->to(base_url('dashboard') . '/kategori');
            } else {
                if ($q['kategori'] == '') {
                    $q['kategori'] = firstWordUpCase($kategori) . ':';
                } else {
                    $q['kategori'] = $q['kategori'] . '|' . firstWordUpCase($kategori) . ':';
                }
            }
            if ($mod->save($q)) {
                session()->setFlashdata('sukses', 'Gagal!. Data tidak ditemukan');
                return redirect()->to(base_url('dashboard') . '/kategori');
            }
        }

        $username = $this->request->getVar('username');
        if ($username == '') {
            session()->setFlashdata('gagal', 'Gagal!. Masukkan nama pemilih.');
            return redirect()->to(base_url('dashboard') . '/kategori');
        }
        $kategori = $this->request->getVar('kategori');
        $id = $this->request->getVar('id');

        $res = updatekategori($order, $id, $kategori, $username);

        if ($res) {
            session()->setFlashdata('sukses', 'Gagal!. Data tidak ditemukan');
            return redirect()->to(base_url('dashboard') . '/kategori');
        }
    }


    public function calon()
    {
        $mod = \App\Models\Capres::class;
        $mod = new $mod;
        $q = $mod->orderBy('tahun', 'DESC')->findAll();
        $data = [
            'judul' => 'Candidates',
            'data' => $q
        ];
        return view('calon', $data);
    }
    public function tambahcalon()
    {
        $data = [
            'judul' => 'Tambah Calon'
        ];
        return view('tambahcalon', $data);
    }
    public function submitcalon()
    {
        $tahun = $this->request->getVar('tahun');
        $pondok = $this->request->getVar('pondok');
        $no_partai = $this->request->getVar('no_partai');
        $partai = $this->request->getVar('partai');
        $singkatan_partai = $this->request->getVar('singkatan_partai');
        $capres = $this->request->getVar('capres');
        $riwayat_capres = $this->request->getVar('riwayat_capres');
        $cawapres = $this->request->getVar('cawapres');
        $riwayat_cawapres = $this->request->getVar('riwayat_cawapres');
        $visi = $this->request->getVar('visi');
        $misi = $this->request->getVar('misi');
        $logo_partai = $this->request->getFile('logo_partai');
        $randomname = 'default.jpg';

        if ($logo_partai->getError() == 0) {
            $randomname = $logo_partai->getRandomName();

            $size = (int)str_replace(".", "", $logo_partai->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('dashboard/tambahcalon'));
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $logo_partai->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('dashboard/tambahcalon'));
            }

            $logo_partai->move('images/', $randomname);
        }

        $data = [
            'tahun' => $tahun,
            'pondok' => $pondok,
            'no_partai' => $no_partai,
            'partai' => $partai,
            'singkatan_partai' => $singkatan_partai,
            'logo_partai' => $randomname,
            'capres' => $capres,
            'riwayat_capres' => $riwayat_capres,
            'cawapres' => $cawapres,
            'riwayat_cawapres' => $riwayat_cawapres,
            'visi' => $visi,
            'misi' => $misi
        ];

        $mod = \App\Models\Capres::class;
        $mod = new $mod;

        if ($mod->save($data)) {
            session()->setFlashdata('sukses', 'Gagal!. Data tidak ditemukan');
            return redirect()->to(base_url('dashboard') . '/calon');
        }
    }
    public function editcalon($id)
    {
        $mod = \App\Models\Capres::class;
        $mod = new $mod;

        $q = $mod->where('id', $id)->first();

        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. Data tidak ditemukan');
            return redirect()->to(base_url('dashboard') . '/calon');
        }
        $data = [
            'judul' => 'Edit Calon',
            'data' => $q
        ];
        return view('editcalon', $data);
    }
    public function updatecalon()
    {
        $mod = \App\Models\Capres::class;
        $mod = new $mod;

        $id = $this->request->getVar('id');
        $logo_partai = $this->request->getFile('logo_partai');


        $q = $mod->where('id', $id)->first();

        $q['tahun'] = $this->request->getVar('tahun');
        $q['pondok'] = $this->request->getVar('pondok');
        $q['no_partai'] = $this->request->getVar('no_partai');
        $q['partai'] = $this->request->getVar('partai');
        $q['singkatan_partai'] = $this->request->getVar('singkatan_partai');
        $q['capres'] = $this->request->getVar('capres');
        $q['riwayat_capres'] = $this->request->getVar('riwayat_capres');
        $q['cawapres'] = $this->request->getVar('cawapres');
        $q['riwayat_cawapres'] = $this->request->getVar('riwayat_cawapres');
        $q['visi'] = $this->request->getVar('visi');
        $q['misi'] = $this->request->getVar('misi');

        if ($logo_partai->getError() == 0) {
            $randomname = $logo_partai->getRandomName();

            $size = (int)str_replace(".", "", $logo_partai->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('single') . '/' . $q['slug']);
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $logo_partai->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('single') . '/' . $q['slug']);
            }

            $logo_partai->move('images/', $randomname);

            if ($q['logo_partai'] !== 'default.jpg') {
                unlink('images/' . $q['logo_partai']);
            }
            $q['logo_partai'] = $randomname;
        }
        if ($mod->save($q)) {
            session()->setFlashdata('sukses', 'Artikel berhasil diupdate!');
            return redirect()->to(base_url('dashboard') . '/editcalon/' . $id);
        }
    }
    public function deletecalon($id)
    {
        $mod = \App\Models\Capres::class;
        $mod = new $mod;

        $q = $mod->where('id', $id)->first();

        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. Data tidak ditemukan');
            return redirect()->to(base_url('dashboard') . '/calon');
        }
    }




    public function absen()
    {
        helper('functions');
        $gender = $this->request->getVar('gender');
        $kategori = $this->request->getVar('kategori');
        $order = $this->request->getVar('order');
        $val = $this->request->getVar('val');
        $id = $this->request->getVar('id');
        if ($order == 'insertabsen') {
            $username = $this->request->getVar('username');


            $mod = \App\Models\Capres::class;
            $mod = new $mod;

            $q = $mod->where('id', $id)->first();

            $q['absen'] = $username;


            if ($mod->save($q)) {
                $res = [
                    'status' => '200'
                ];
                echo json_encode($res);
            }
            die;
        }
        if ($order == 'cariabsenkategori') {

            $mod = \App\Models\Users::class;
            $mod = new $mod;

            $q = $mod->select('nama,username')->like('nama', $val, 'both')->find();



            $res = [
                'status' => '200',
                'data' => $q
            ];
            echo json_encode($res);
            die;
        }

        $pemilih = absen($order, $gender,  $id, $kategori, $val);

        $req = [
            'status' => '200',
            'data' => $pemilih
        ];
        echo json_encode($req);
        die;
    }

    public function putra()
    {
        helper('functions');
        $res = votingpage('Putra');
        // dd($res);
        $data = [
            'judul' => 'Putra',
            'data' => $res
        ];
        return view('voting', $data);
    }
    public function putri()
    {
        helper('functions');
        $res = votingpage('Putri');

        $data = [
            'judul' => 'Putri',
            'data' => $res
        ];
        return view('voting', $data);
    }

    public function vote()
    {
        helper('functions');

        $idpartai = $this->request->getVar('idpartai');
        $idcapres = $this->request->getVar('idcapres');
        $username = $this->request->getVar('username');
        $poin = $this->request->getVar('poin');
        $res = vote($idcapres, $idpartai, $username, $poin);

        if ($res) {
            $status = '200';
        } else {
            $status = '400';
        }
        $data = [
            'status' => $status
        ];

        echo json_encode($data);
        die;
    }


    public function statistik()
    {
        helper('functions');
        $data = [
            'judul' => 'Statistik',
            'data' => [
                'putra' => statistik('Putra'),
                'putri' => statistik('Putri')
            ]
        ];

        return view('statistik', $data);
    }
}

<?php
function kategori($gender, $kategori = null)
{
    $pondok = 'Putra';
    if ($gender == 'P') {
        $pondok = 'Putri';
    }

    $res = [];
    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    if ($kategori == null) {
        $q = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

        if ($q) {
            $exppart = explode("|", $q['kategori']);
            foreach ($exppart as $i) {
                $expkategori = explode(":", $i);
                if (count($expkategori) > 1) {
                    $user = explode(",", $expkategori[1]);

                    $profile = profile($user);
                    $res[] = [
                        'kategori' => $expkategori[0],
                        'data' => $profile,
                        'id' => $q['id']

                    ];
                }
            }
        }
    } else {
        $q = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

        if ($q) {
            $exppart = explode("|", $q['kategori']);

            foreach ($exppart as $i) {
                $expkategori = explode(":", $i);
                if (count($expkategori) > 1) {
                    if ($expkategori[0] == $kategori) {
                        $res = [
                            'id' => $q['id'],
                            'data' => explode(",", $expkategori[1])
                        ];
                    }
                }
            }
        }
    }
    return $res;
}

function updatekategori($order, $id, $kategori, $username)
{
    $res = [];
    $mod = \App\Models\Capres::class;
    $mod = new $mod;
    $q = $mod->where("id", $id)->first();

    if ($q) {
        $exppart = explode("|", $q['kategori']);
        foreach ($exppart as $i) {
            $expkategori = explode(":", $i);
            if (count($expkategori) > 1) {
                $user = explode(",", $expkategori[1]);


                if ($expkategori[0] == $kategori) {
                    if ($order == 'delete') {
                        if (array_search($username, $user) !== false) {
                            $index = array_search($username, $user);
                            unset($user[$index]);
                        }
                    }
                    if ($order == 'tambah') {
                        if ($expkategori[1] == '') {
                            $user = [$username];
                        } else {
                            $user[] = $username;
                        }
                    }
                }

                $res[] = [
                    'kategori' => $expkategori[0],
                    'username' => $user,
                    'id' => $q['id']
                ];
            }
        }
    }

    $value = [];
    foreach ($res as $i) {
        $imp = implode(",", $i['username']);
        $value[] = $i['kategori'] . ':' . $imp;
    }
    $q['kategori'] = implode("|", $value);
    if ($mod->save($q)) {
        return true;
    }
}

function profile($data)
{
    $mod = \App\Models\Users::class;
    $mod = new $mod;
    $res = [];
    foreach ($data as $i) {
        $q = $mod->select('id,nama,username,sub,kecamatan')->where('username', $i)->first();
        $res[] = $q;
    }

    return $res;
}

function absen($order, $gender, $id, $kategori = null, $val = '')
{
    $pondok = 'Putra';
    if ($gender == 'P') {
        $pondok = 'Putri';
    }
    $capres = \App\Models\Capres::class;
    $capres = new $capres;


    $sudahmencoblos = '900000000';
    $selesai = [];
    if ($order == 'absen') {
        $q = $capres->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

        $mod = \App\Models\Users::class;
        $mod = new $mod;

        if ($q) {
            if ($q['absen'] !== '') {
                return $mod->select('id, username,nama,sub,kecamatan')->where('username', $q['absen'])->first();
            }
        }
        return false;
    }

    if ($order == 'cariabsenkategori') {
        $selesai = $capres->where("id", $id)->first();
    }

    $selesai = $capres->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();


    if ($selesai['selesai'] !== '') {
        $sudahmencoblos = $sudahmencoblos . ',' . $selesai['selesai'];
    }
    if (upstain($pondok) !== '') {
        $sudahmencoblos = $sudahmencoblos . ',' . upstain($pondok);
    }



    if ($order == 'cariabsen' || $order == 'cariabsenkategori') {
        $mod = \App\Models\Users::class;
        $mod = new $mod;
        $q = [];
        $where = explode(',', $sudahmencoblos);
        $query = $mod->select('username,nama')->whereNotIn('username', $where)->where('gender', $gender)->like("nama", $val, 'both')->find();

        if ($kategori == 'Santri') {
            foreach ($query as $i) {
                if (strlen($i['username']) < 7) {
                    $q[] = $i;
                }
            }
        } else if ($kategori == 'Karyawan') {
            $sudahmencoblos = $sudahmencoblos . ',' . spesial();
            $where = explode(',', $sudahmencoblos);
            $query = $mod->select('username,nama')->whereNotIn('username', $where)->where('gender', $gender)->like("nama", $val, 'both')->find();
            foreach ($query as $i) {
                if (strlen($i['username']) > 7) {
                    $q[] = $i;
                }
            }
        } else {
            $username = kategori($gender, $kategori);
            // dd($sudahmencoblos);
            foreach ($query as $i) {
                if (in_array($i['username'], $username['data'])) {
                    $q[] = $i;
                }
            }
        }
        return $q;
    }
    if ($order == 'antrian') {
        $mod = \App\Models\Users::class;
        $mod = new $mod;
        $q = [];
        $where = explode(',', $sudahmencoblos);
        $query = $mod->select('username,nama')->whereNotIn('username', $where)->where('gender', $gender)->limit(10)->find();

        if ($kategori == 'Santri') {
            foreach ($query as $i) {
                if (strlen($i['username']) < 7) {
                    $q[] = $i;
                }
            }
        } else if ($kategori == 'Karyawan') {
            $sudahmencoblos = $sudahmencoblos . ',' . spesial();
            $where = explode(',', $sudahmencoblos);
            $query = $mod->select('username,nama')->whereNotIn('username', $where)->where('gender', $gender)->limit(10)->find();
            foreach ($query as $i) {
                if (strlen($i['username']) > 7) {
                    $q[] = $i;
                }
            }
        } else {
            $username = kategori($gender, $kategori);

            foreach ($query as $i) {
                if (in_array($i['username'], $username['data'])) {
                    $q[] = $i;
                }
            }
        }
        return $q;
    }
}

function firstWordUpCase($text)
{
    $newText = ucwords(strtolower($text));
    return $newText;
}

// gabungan kategori khusus: ndalem, dewan dll
function spesial()
{
    $res = [];
    $mod = \App\Models\Capres::class;
    $mod = new $mod;


    $l = $mod->where("pondok", 'Putra')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();
    $p = $mod->where("pondok", 'Putri')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $expl = explode("|", $l['kategori']);

    $usernames = [];
    foreach ($expl as $i) {
        $expkat = explode(":", $i);
        if (count($expkat) > 1) {
            $usernames[] = $expkat[1];
        }
    }

    $expp = explode("|", $p['kategori']);

    foreach ($expp as $i) {
        $expkat = explode(":", $i);
        if (count($expkat) > 1) {
            $usernames[] = $expkat[1];
        }
    }
    $res = trim(implode(",", $usernames));
    if (substr($res, -1) == ',') {
        $res = substr($res, 0, -1);
    }
    return $res;
}

function votingpage($pondok)
{
    $gender = "L";
    if ($pondok == 'Putri') {
        $gender = "P";
    }

    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    $user = \App\Models\Users::class;
    $user = new $user;

    $absen = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $pemilih = $user->select('id,username,nama,sub,kecamatan')->where('username', $absen['absen'])->first();


    $kategori = 'Santri';

    if (strlen($pemilih['username']) > 7) {
        $kategori = 'Karyawan';
        $dewan = kategori($gender, 'Dewan');
        if (in_array($pemilih['username'], $dewan['data'])) {
            $kategori = 'Dewan';
        }
        $ndalem = kategori($gender, 'Ndalem');
        if (in_array($pemilih['username'], $ndalem['data'])) {
            $kategori = 'Ndalem';
        }
    }

    $poin = poin($kategori);

    $partai = [];
    if ($kategori == 'Ndalem') {
        $ndalem = ndalem($pondok);
        if ($ndalem['status'] === true) {
            $absenL = $mod->where("pondok", 'Putra')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();
            $absenP = $mod->where("pondok", 'Putri')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();
            if (count($ndalem['belum']) == 2) {
                $partai[] = [
                    'pondok' => 'Putra',
                    'idcapres' =>  $absenL['id'],
                    'partai' => $mod->where("pondok", 'Putra')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
                ];
                $partai[] = [
                    'pondok' => 'Putri',
                    'idcapres' =>  $absenP['id'],
                    'partai' => $mod->where("pondok", 'Putri')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
                ];
            } else if (count($ndalem['belum']) == 1) {
                if ($ndalem['belum'][0] == 'putra') {
                    $partai[] = [
                        'pondok' => 'Putra',
                        'idcapres' =>  $absenL['id'],
                        'partai' => $mod->where("pondok", 'Putra')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
                    ];
                } else {
                    $partai[] = [
                        'pondok' => 'Putri',
                        'idcapres' =>  $absenP['id'],
                        'partai' => $mod->where("pondok", 'Putri')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
                    ];
                }
            }
        }
    } else {
        $partai[] = [
            'pondok' => $pondok,
            'idcapres' =>  $absen['id'],
            'partai' => $mod->where("pondok", $pondok)->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
        ];
    }
    $res = [
        'kategori' => $kategori,
        'poin' => $poin,
        'pemilih' => $pemilih,
        'partai' => $partai
    ];

    return $res;
}

function poin($kategori)
{
    $res = [
        ['kategori' => 'Ndalem', 'poin' => 5],
        ['kategori' => 'Dewan', 'poin' => 3],
        ['kategori' => 'Karyawan', 'poin' => 2],
        ['kategori' => 'Santri', 'poin' => 1]
    ];

    $poin = 0;
    foreach ($res as $i) {
        if ($i['kategori'] == $kategori) {
            $poin = $i['poin'];
        }
    }

    return $poin;
}

function voted($pondok)
{

    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    $absen = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $voted = explode(",", $absen['selesai']);
    $ndalem = ndalem($pondok);

    if ($ndalem['status'] === true) {
        if (count($ndalem['sudah']) < 2) {
            return true;
        }
    } else {
        if (in_array($absen['absen'], $voted)) {
            return false;
        } else {
            return true;
        }
    }
}

function upstain($pondok)
{
    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    $absenL = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $usernames = [];
    $exp = explode('|', $absenL['kategori']);

    foreach ($exp as $i) {
        $expkat = explode(":", $i);
        if (count($expkat) > 1) {
            if ($expkat[0] == 'Upstain') {
                $usernames[] = $expkat[1];
            }
        }
    }


    $absenP = $mod->where("pondok", 'Putri')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $exp = explode('|', $absenP['kategori']);

    foreach ($exp as $i) {
        $expkat = explode(":", $i);
        if (count($expkat) > 1) {
            if ($expkat[0] == 'Upstain') {
                $usernames[] = $expkat[1];
            }
        }
    }

    $res = implode(",", $usernames);
    return $res;
}

function vote($idcapres, $idpartai, $username, $poin)
{
    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    $selesai = $mod->where('id', $idcapres)->first();

    if ($selesai['selesai'] == '') {
        $selesai['selesai'] = $username;
    } else {
        $selesai['selesai'] = $selesai['selesai'] . ',' . $username;
    }

    if ($mod->save($selesai)) {
        $partai = $mod->where('id', $idpartai)->first();
        $partai['suara'] = $partai['suara'] + $poin;
        if ($mod->save($partai)) {
            return true;
        }
    }

    return false;
}

function statistik($pondok)
{
    $gender = "L";
    if ($pondok == 'Putri') {
        $gender = 'P';
    }


    $mod = \App\Models\Users::class;
    $mod = new $mod;

    $capres = \App\Models\Capres::class;
    $capres = new $capres;

    $partai = $capres->select('id,no_partai,partai,singkatan_partai,logo_partai,capres,cawapres,suara')->where('tahun', date('Y'))->where('pondok', $pondok)->find();

    $selesai = selesai($pondok);
    $where = '900000000';
    $where .= ',' . upstain($pondok);

    if (count($selesai) > 0) {
        $where .= ',' . $selesai['username'];
    }

    $exp = explode(",", $where);
    $q = $mod->select('id,username,nama,sub,kecamatan')->whereNotIn('username', $exp)->where('gender', $gender)->find();

    $res = [
        'pondok' => $pondok,
        'partai' => $partai,
        'selesai' => [
            'jumlah' => (count($selesai) > 1 ? $selesai['jumlah'] : 0),
            'profile' => (count($selesai) > 1 ? $selesai['profile'] : [])
        ],
        'belum' => [
            'jumlah' => count($q),
            'profile' => $q
        ]
    ];

    return $res;
}


function selesai($pondok)
{
    $mod = \App\Models\Capres::class;
    $mod = new $mod;

    $absen = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $res = [];
    $profile = [];

    $exp = explode(",", $absen['selesai']);
    if ($absen['selesai'] !== '') {
        $users = \App\Models\Users::class;
        $users = new $users;
        foreach ($exp as $i) {
            $q = $users->where('username', $i)->first();
            $profile[] = [
                'id' => $q['id'],
                'username' => $q['username'],
                'nama' => $q['nama'],
                'sub' => $q['sub'],
                'kecamatan' => $q['kecamatan']
            ];
        }


        $username = $absen['selesai'];
        $jumlah = count($exp);

        $res = [
            'pondok' => $pondok,
            'username' => $username,
            'profile' => $profile,
            'jumlah' => $jumlah
        ];
    }

    return $res;
}

function ndalem($pondok)
{
    $gender = "L";
    if ($pondok == 'Putri') {
        $gender = 'P';
    }


    $mod = \App\Models\Capres::class;
    $mod = new $mod;
    $ndalem = false;
    $absen = $mod->where("pondok", $pondok)->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

    $kat = kategori($gender, 'Ndalem');

    if (in_array($absen['absen'], $kat['data'])) {
        $ndalem = true;
    }

    $res = [
        'status' => $ndalem,
        'belum' => ['putra', 'putri'],
        'sudah' => []
    ];

    if ($ndalem) {
        $capresL = $mod->where("pondok", 'Putra')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();
        $capresP = $mod->where("pondok", 'Putri')->orderBy('tahun', date('Y'))->orderBy('id', 'ASC')->first();

        $expL = explode(',', $capresL['selesai']);
        $expP = explode(',', $capresP['selesai']);

        if (in_array($absen['absen'], $expL) && in_array($absen['absen'], $expP)) {
            $res['belum'] = [];
            $res['sudah'] = ['putra', 'putri'];
        } else if (in_array($absen['absen'], $expL)) {
            $res['belum'] = ['putri'];
            $res['sudah'] = ['putra'];
        } else if (in_array($absen['absen'], $expP)) {
            $res['belum'] = ['putra'];
            $res['sudah'] = ['putri'];
        }
    }

    return $res;
}


// Untuk halaman yang login byusername
function voteusername()
{
    $user = \App\Models\Users::class;
    $user = new $user;


    $u = $user->select('id,username,nama,sub,kecamatan,gender')->where('username', session('username'))->first();

    $pondok = 'Putra';

    if ($u['gender'] == 'P') {
        $pondok = 'Putri';
    }

    $kategori = 'Santri';

    $capres = \App\Models\Capres::class;
    $capres = new $capres;

    if (strlen($u['username']) > 7) {
        $kategori = 'Karyawan';
        $dewan = kategori($u['gender'], 'Dewan');
        if (in_array($u['username'], $dewan['data'])) {
            $kategori = 'Dewan';
        }
        $ndalem = kategori($u['gender'], 'Ndalem');
        if (in_array($u['username'], $ndalem['data'])) {
            $kategori = 'Ndalem';
        }
    }
    $poin = poin($kategori);

    $partai = [];
    if ($kategori == 'Ndalem') {
        $cL = $capres->where('pondok', 'Putra')->where('tahun', date('Y'))->orderBy('id', 'ASC')->first();
        $cP = $capres->where('pondok', 'Putri')->where('tahun', date('Y'))->orderBy('id', 'ASC')->first();

        $expL = explode(',', $cL['selesai']);
        $expP = explode(',', $cP['selesai']);

        if (!in_array(session('username'), $expL) && !in_array(session('username'), $expP)) {
            $partai[] = [
                'pondok' => 'Putra',
                'idcapres' =>  $cL['id'],
                'partai' => $capres->where("pondok", 'Putra')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
            ];
            $partai[] = [
                'pondok' => 'Putri',
                'idcapres' =>  $cP['id'],
                'partai' => $capres->where("pondok", 'Putri')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
            ];
        } else if (in_array(session('username'), $expL) && in_array(session('username'), $expP)) {
            $partai = [];
        } else if (in_array(session('username'), $expL)) {
            $partai[] = [
                'pondok' => 'Putri',
                'idcapres' =>  $cP['id'],
                'partai' => $capres->where("pondok", 'Putri')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
            ];
        } else if (in_array(session('username'), $expP)) {
            $partai[] = [
                'pondok' => 'Putra',
                'idcapres' =>  $cL['id'],
                'partai' => $capres->where("pondok", 'Putra')->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
            ];
        }
    } else {
        $c = $capres->where('pondok', $pondok)->where('tahun', date('Y'))->orderBy('id', 'ASC')->first();
        $partai[] = [
            'pondok' => $pondok,
            'idcapres' =>  $c['id'],
            'partai' => $capres->where("pondok", $pondok)->where("tahun", date('Y'))->orderBy('no_partai', 'ASC')->find()
        ];
    }
    $res = [
        'kategori' => $kategori,
        'poin' => $poin,
        'pemilih' => $u,
        'partai' => $partai
    ];
    return $res;
}

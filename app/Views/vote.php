<?= $this->extend('templates/voting'); ?>

<?= $this->section('content'); ?>
<?php
// dd($data);
?>
<div class="container mt-3">
    <?php if (!$upstain) : ?>
        <div style="text-align:center;margin-top:100">
            <small style="text-align:center; font-size:xx-large">ANDA TIDAK PUNYA HAK PILIH!</small>
            <br>
            <a style="text-align:center" href="<?= base_url(); ?>/login/logout">Logout</a>
        </div>
</div>
<?php die; ?>
<?php endif; ?>
<div class="row justify-content-center mb-3">
    <div class="col-md-2">
        <div class="card bg-info text-light">
            <div class="card-body text-center">
                <?= $data['pemilih']['username']; ?>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card bg-info text-light">
            <div class="card-body text-center">
                <?= $data['pemilih']['nama']; ?>/<?= $data['kategori']; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-light">
            <div class="card-body text-center">
                <?= $data['poin']; ?>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-info text-light">
            <div class="card-body text-center">
                <?= $data['pemilih']['sub']; ?>
            </div>
        </div>
    </div>
</div>
<?php

if ($data['kategori'] == 'Ndalem' || $data['kategori'] == 'Karyawan') : ?>
    <?php if (count($data['partai']) == 0) : ?>
        <div class="card mb-3">
            <div class="card-body text-center">
                ANDA SUDAH MEMILIH CAPRES/CAWAPRES ISWA PONDOK PUTRA DAN PUTRI TAHUN <?= date('Y'); ?>
            </div>
        </div>
    <?php elseif (count($data['partai']) == 1) : ?>
        <div class="card mb-3">
            <div class="card-body text-center">
                ANDA SUDAH MEMILIH CAPRES/CAWAPRES ISWA PONDOK <?= ($data['partai'][0]['pondok'] == 'Putra' ? 'PUTRI' : 'PUTRA'); ?> TAHUN <?= date('Y'); ?>
            </div>
        </div>

    <?php endif; ?>
<?php else : ?>
    <?php if (count($data['partai']) == 0) : ?>
        <div class="card mb-3">
            <div class="card-body text-center">
                ANDA SUDAH MEMILIH CAPRES/CAWAPRES ISWA PONDOK <?= ($data['partai'][0]['pondok'] == 'Putra' ? 'PUTRI' : 'PUTRA'); ?> TAHUN <?= date('Y'); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
<?php foreach ($data['partai'] as $p) : ?>
    <h6 class="bg-light text-dark p-2 text-center"><?= strtoupper($p['pondok']); ?></h6>
    <div class="row g-1 mb-4">
        <?php foreach ($p['partai'] as $i) : ?>
            <div class="col-md-4">
                <div class="card" style="background-color:azure;">
                    <a href="#" class="vote" data-idcapres="<?= $p['idcapres']; ?>" data-poin="<?= $data['poin']; ?>" data-username="<?= $data['pemilih']['username']; ?>" data-idpartai="<?= $i['id']; ?>">
                        <img src="<?= base_url(); ?>/images/<?= $i['logo_partai']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body bg-info text-light">
                        <h5 class="card-title"><?= $i['partai']; ?>/<?= $i['singkatan_partai']; ?>/<?= $i['no_partai']; ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-info text-light" style="font-style:italic;"><?= $i['capres']; ?></li>
                            <li class="list-group-item bg-info text-light" style="font-style:italic;"><?= $i['cawapres']; ?></li>
                        </ul>
                    </div>
                    <div class="title" style="border-radius:0px;">VISI</div>
                    <div class="px-3">
                        <p><?= $i['visi']; ?></p>
                    </div>
                    <div class="title" style="border-radius:0px;">MISI</div>
                    <div class="px-3">
                        <p><?= $i['misi']; ?></p>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

</div>
<?= $this->endSection(); ?>
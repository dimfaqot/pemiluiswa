<?= $this->extend('templates/voting'); ?>

<?= $this->section('content'); ?>

<?php
// $ndalem = ndalem($judul);
// dd($data);

if ($data['kategori'] == 'Ndalem' || $data['kategori'] == 'Karyawan') {
    if (count($data['partai']) == 1) {
        $pondoksudah = 'putra';

        if ($data['partai'][0]['pondok'] == 'Putra') {
            $pondoksudah = 'putra';
        }
    }
}
?>
<div class="container mt-3">
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
                    Poin: <?= $data['poin']; ?>
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
    $ndalem = ndalem($judul);
    if ($data['kategori'] == 'Ndalem' || $data['kategori'] == 'Karyawan') : ?>
        <?php if (count($data['partai']) == 1) : ?>
            <div class="card mb-3">
                <div class="card-body text-center">
                    ANDA SUDAH MEMILIH CAPRES/CAWAPRES PONDOK <?= strtoupper($pondoksudah); ?>
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
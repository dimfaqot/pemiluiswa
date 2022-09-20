<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>
<?php
// helper('functions');
helper('form');
// dd(spesial());
?>
<div class="container mt-3 mb-5">
    <div class="card mb-3">
        <div class="title">Absen Putra</div>
        <div class="card-body">

            <!-- PUTRA -->
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= base_url(); ?>/dashboard/absen" method="post">
                        <div class="d-flex gap-2" style="font-size:small;">
                            <?php if (count($kategoril) > 0) : ?>
                                <?php foreach ($kategoril as $i) : ?>
                                    <?php if ($i['kategori'] !== 'Upstain') : ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input kategori" data-gender="L" data-id="<?= $i['id']; ?>" name="kategori" value="<?= $i['kategori']; ?>" type="radio" role="switch">
                                            <label class="form-check-label"><?= $i['kategori']; ?></label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-check form-switch">
                                <input class="form-check-input kategori" data-gender="L" data-id="<?= $i['id']; ?>" name="kategori" value="Karyawan" type="radio" role="switch">
                                <label class="form-check-label">Karyawan</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input kategori" data-gender="L" data-id="<?= $i['id']; ?>" name="kategori" value="Santri" type="radio" role="switch">
                                <label class="form-check-label">Santri</label>
                            </div>
                        </div>
                        <div class="input-group input-group-sm mb-3" style="width:300px;">
                            <input type="text" name="username" data-gender="L" data-id="<?= $i['id']; ?>" class="form-control select submit<?= date('Y'); ?>cariabsenL searchL" data-tahun="<?= date('Y'); ?>" data-gender="L" data-order="cariabsen" placeholder="Cari nama pemilih" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <button class="btn btn-info btn-sm text-light insertabsen" data-gender="L" data-id="<?= $i['id']; ?>" data-order="insertabsen" type="button" id="button-addon2">Buat Absen Putra</button>
                            <div class="list-group body<?= date('Y'); ?>cariabsenL" style="font-size:small;position:absolute;z-index:50; width:300px; top:30px;">

                            </div>
                        </div>

                    </form>

                    <ul class="list-group list-group absenL">

                    </ul>

                </div>
                <div class="col-md-6">
                    <div class="list-group antrianL">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-3">
        <div class="title">Absen Putri</div>
        <div class="card-body">

            <!-- PUTRi -->
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= base_url(); ?>/dashboard/absen" method="post">
                        <div class="d-flex gap-2" style="font-size:small;">
                            <?php if (count($kategorip) > 0) : ?>
                                <?php foreach ($kategorip as $i) : ?>
                                    <?php if ($i['kategori'] !== 'Upstain') : ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input kategori" data-gender="P" data-id="<?= $i['id']; ?>" name="kategori" value="<?= $i['kategori']; ?>" type="radio" role="switch">
                                            <label class="form-check-label"><?= $i['kategori']; ?></label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-check form-switch">
                                <input class="form-check-input kategori" data-gender="P" data-id="<?= $i['id']; ?>" name="kategori" value="Karyawan" type="radio" role="switch">
                                <label class="form-check-label">Karyawan</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input kategori" data-gender="P" data-id="<?= $i['id']; ?>" name="kategori" value="Santri" type="radio" role="switch">
                                <label class="form-check-label">Santri</label>
                            </div>
                        </div>
                        <div class="input-group input-group-sm mb-3" style="width:300px;">
                            <input type="text" name="username" data-gender="P" data-id="<?= $i['id']; ?>" class="form-control select submit<?= date('Y'); ?>cariabsenP searchP" data-tahun="<?= date('Y'); ?>" data-gender="P" data-order="cariabsen" placeholder="Cari nama pemilih" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <button class="btn btn-info btn-sm text-light insertabsen" data-gender="P" data-id="<?= $i['id']; ?>" data-order="insertabsen" type="button" id="button-addon2">Buat Absen Putri</button>
                            <div class="list-group body<?= date('Y'); ?>cariabsenP" style="font-size:small;position:absolute;z-index:50; width:300px; top:30px;">

                            </div>
                        </div>

                    </form>

                    <ul class="list-group list-group absenP">

                    </ul>

                </div>
                <div class="col-md-6">
                    <div class="list-group antrianP">
                    </div>
                </div>
            </div>

        </div>
    </div>



</div>
<?= $this->endSection(); ?>
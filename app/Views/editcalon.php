<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>
<?php

helper('form');
$pondok = ['Putra', 'Putri'];
// dd($data);
?>
<div class="container mt-3">
    <div class="card">
        <div class="title">Capres/Cawapres</div>
        <div class="card-body">
            <?= form_open_multipart('dashboard/updatecalon'); ?>
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Tahun</span>
                <input type="text" name="tahun" value="<?= $data['tahun']; ?>" class="form-control" placeholder="Tahun" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <label style="width:130px;" class="input-group-text">Pondok</label>
                <select class="form-select" name="pondok">
                    <?php foreach ($pondok as $i) : ?>

                        <?php if ($i == $data['pondok']) : ?>
                            <option value="<?= $i; ?>" selected><?= $i; ?></option>

                        <?php else : ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>

                        <?php endif; ?>

                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">No. Partai</span>
                <input type="text" name="no_partai" value="<?= $data['no_partai']; ?>" class="form-control" placeholder="Nomor partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Partai</span>
                <input type="text" class="form-control" value="<?= $data['partai']; ?>" name="partai" placeholder="Nama Partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Singkatan</span>
                <input type="text" class="form-control" value="<?= $data['singkatan_partai']; ?>" name="singkatan_partai" placeholder="Singkatan partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="row">
                <div class="col-md-2">
                    <img class="img-fluid" src="<?= base_url(); ?>/images/<?= $data['logo_partai']; ?>" alt="Logo Partai">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label style="width:130px;" class="input-group-text">Ganti Logo Partai</label>
                    <input type="file" name="logo_partai" class="form-control">
                </div>

            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Capres</span>
                <input type="text" name="capres" class="form-control" value="<?= $data['capres']; ?>" name="Nama capres" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Riwayat Capres</span>
                <textarea class="form-control" name="riwayat_capres" aria-label="With textarea"><?= $data['riwayat_capres']; ?></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Cawapres</span>
                <input type="text" name="cawapres" class="form-control" value="<?= $data['riwayat_capres']; ?>" name="Nama cawapres" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Riwayat Cawapres</span>
                <textarea class="form-control" name="riwayat_cawapres" aria-label="With textarea"><?= $data['riwayat_cawapres']; ?></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Visi</span>
                <textarea class="form-control" name="visi" aria-label="With textarea"><?= $data['visi']; ?></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Misi</span>
                <textarea class="form-control" name="misi" aria-label="With textarea"><?= $data['misi']; ?></textarea>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-info btn-sm text-light" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
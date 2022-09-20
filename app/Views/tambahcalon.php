<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>
<?php

helper('form');
?>

<div class="container mt-3">
    <div class="card">
        <div class="title">Capres/Cawapres</div>
        <div class="card-body">
            <?= form_open_multipart('dashboard/submitcalon') ?>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Tahun</span>
                <input type="text" name="tahun" class="form-control" placeholder="Tahun" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <label style="width:130px;" class="input-group-text">Pondok</label>
                <select class="form-select" name="pondok">
                    <option value="Putra" selected>Putra</option>
                    <option value="Putri">Putri</option>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">No. Partai</span>
                <input type="text" name="no_partai" class="form-control" placeholder="Nomor partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Partai</span>
                <input type="text" class="form-control" name="partai" placeholder="Nama Partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Singkatan</span>
                <input type="text" class="form-control" name="singkatan_partai" placeholder="Singkatan partai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <label style="width:130px;" class="input-group-text">Logo Partai</label>
                <input type="file" name="logo_partai" class="form-control">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Capres</span>
                <input type="text" name="capres" class="form-control" name="Nama capres" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Riwayat Capres</span>
                <textarea class="form-control" name="riwayat_capres" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Cawapres</span>
                <input type="text" name="cawapres" class="form-control" name="Nama cawapres" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Riwayat Cawapres</span>
                <textarea class="form-control" name="riwayat_cawapres" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Visi</span>
                <textarea class="form-control" name="visi" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:130px;" class="input-group-text">Misi</span>
                <textarea class="form-control" name="misi" aria-label="With textarea"></textarea>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-info btn-sm text-light" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
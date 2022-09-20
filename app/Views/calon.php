<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>

<div class="container mt-3 mb-5">

    <div class="card mb-3">
        <div class="title mb-3">Candidates</div>
        <a style="width:200px;" class="btn btn-sm btn-info ms-3 text-light" href="<?= base_url('dashboard'); ?>/tambahcalon" role="button">Tambah Capres</a>
        <div class="card-body">
            <?php foreach ($data as $i) : ?>
                <div class="list-group mb-1">
                    <a href="<?= base_url(); ?>/dashboard/editcalon/<?= $i['id']; ?>" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"><?= $i['partai']; ?>/<?= $i['singkatan_partai']; ?></h6>
                            <small>No. Partai: <?= $i['no_partai']; ?> Tahun: <?= $i['tahun']; ?></small>
                        </div>
                        <p class="mb-1"><?= $i['capres']; ?></p>
                        <small><?= $i['cawapres']; ?></small>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>
<?= $this->endSection(); ?>
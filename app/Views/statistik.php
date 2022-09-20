<?= $this->extend('templates/guest'); ?>

<?= $this->section('content'); ?>
<?php
$arr = ['putra', 'putri'];
// dd($data);
?>
<div class="mt-3 mb-5 px-5">
    <div class="row g-3 justify-content-center">
        <?php foreach ($arr as $a) : ?>
            <div class="col-md-6">
                <h1><?= $data[$a]['pondok']; ?></h1>
                <canvas class="mb-3" id="myChart<?= $a; ?>" style="width:100%;max-height:400px;"></canvas>
                <canvas class="m-auto" id="golput<?= $a; ?>" style="max-width:350px;max-height:350px;"></canvas>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= $this->endSection(); ?>
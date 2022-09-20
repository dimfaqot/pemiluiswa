<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>

<div class="container mt-3 mb-5">
    <?php
    // dd(count($kategori['putri']));

    ?>
    <div class="card mb-3">
        <div class="title mb-3">Kategori Pemilih</div>
        <div class="card-body">
            <div class="title mb-3">Putra</div>
            <form action="<?= base_url(); ?>/dashboard/updatekategori" method="post">
                <div class="input-group input-group-sm mb-3" style="width:300px;">
                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <input type="hidden" name="order" value="tambahkategori">
                    <input type="hidden" name="pondok" value="Putra">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Tambah Kategori</button>
                </div>
            </form>
            <?php foreach ($kategori['putra'] as $key => $i) : ?>
                <div><?= $key + 1; ?>. <?= $i['kategori']; ?></div>
                <form action="<?= base_url(); ?>/dashboard/updatekategori" method="post">
                    <div class="input-group input-group-sm mb-3" style="width:300px;">
                        <input type="hidden" name="kategori" value="<?= $i['kategori']; ?>">
                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                        <input type="hidden" name="order" value="tambah">
                        <input type="text" name="username" data-order="cariabsenkategori" class="form-control select submit<?= date('Y') . str_replace(" ", "", $i['kategori']); ?>L" data-tahun="<?= date('Y'); ?>" data-kategori="<?= str_replace(" ", "", $i['kategori']); ?>" data-gender="L" placeholder="Cari nama pemilih" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <button class="btn btn-info btn-sm text-light" type="submit" id="button-addon2">Tambah</button>
                        <div class="list-group body<?= date('Y') . str_replace(" ", "", $i['kategori']); ?>L" style="font-size:small;position:absolute;z-index:50; width:300px; top:30px;">

                        </div>
                    </div>
                </form>
                <?php if ($i['data'][0] !== null) : ?>
                    <?php foreach ($i['data'] as $d) : ?>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:130px;" class="input-group-text">Nama</span>
                            <input type="text" name="tahun" class="form-control" placeholder="Tahun" value="<?= $d['nama']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <form action="<?= base_url('dashboard'); ?>/updatekategori" method="post">
                                <input type="hidden" name="kategori" value="<?= $i['kategori']; ?>">
                                <input type="hidden" name="username" value="<?= $d['username']; ?>">
                                <input type="hidden" name="order" value="delete">
                                <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="title mb-3">Putri</div>
            <form action="<?= base_url(); ?>/dashboard/updatekategori" method="post">
                <div class="input-group input-group-sm mb-3" style="width:300px;">
                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan kategori" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <input type="hidden" name="order" value="tambahkategori">
                    <input type="hidden" name="pondok" value="Putri">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Tambah Kategori</button>
                </div>
            </form>
            <?php foreach ($kategori['putri'] as $key => $i) : ?>
                <div><?= $key + 1; ?>. <?= $i['kategori']; ?></div>
                <form action="<?= base_url(); ?>/dashboard/updatekategori" method="post">
                    <div class="input-group input-group-sm mb-3" style="width:300px;">
                        <input type="hidden" name="kategori" value="<?= $i['kategori']; ?>">
                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                        <input type="hidden" name="order" value="tambah">
                        <input type="text" name="username" data-order="cariabsenkategori" class="form-control select submit<?= date('Y') . str_replace(" ", "", $i['kategori']); ?>P" data-tahun="<?= date('Y'); ?>" data-kategori="<?= str_replace(" ", "", $i['kategori']); ?>" data-gender="P" placeholder="Cari nama pemilih" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <button class="btn btn-info btn-sm text-light" type="submit" id="button-addon2">Tambah</button>
                        <div class="list-group body<?= date('Y') . str_replace(" ", "", $i['kategori']); ?>P" style="font-size:small;position:absolute;z-index:50; width:300px; top:30px;">

                        </div>
                    </div>
                </form>
                <?php if ($i['data'][0] !== null) : ?>
                    <?php foreach ($i['data'] as $d) : ?>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:130px;" class="input-group-text">Nama</span>
                            <input type="text" name="tahun" class="form-control" placeholder="Tahun" value="<?= $d['nama']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <form action="<?= base_url('dashboard'); ?>/updatekategori" method="post">
                                <input type="hidden" name="kategori" value="<?= $i['kategori']; ?>">
                                <input type="hidden" name="username" value="<?= $d['username']; ?>">
                                <input type="hidden" name="order" value="delete">
                                <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>


</div>
<?= $this->endSection(); ?>
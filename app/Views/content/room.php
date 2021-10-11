<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h1>My Room</h1>
    <div class="row">
        <?php foreach ($room as $data) : ?>
            <div class="col-lg-3 mb-3">
                <a href="<?= base_url('room/detail/' . $data['roomid']); ?>" class="text-decoration-none">
                    <div class="card h-100 text-dark bg-light mb-3 p-5">
                        <div class="card-header bg-danger text-center text-white rounded">
                            <h5><?= $data['namaroom']; ?></h5>
                        </div>
                        <div class="card-body">
                            <strong>
                                <p class="card-title"><?= $data['roomid']; ?></p>
                            </strong>
                            <p class="card-text"><?= $data['keterangan']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        <div class="col-lg-3 mb-3">
            <a href="#" data-bs-toggle="modal" data-bs-target="#createroomModal" class="text-decoration-none">
                <div class="card h-100 text-dark text-center bg-light mb-3 justify-content-center align-self-center p-5">
                    <h1><i class="fas fa-plus-square"></i></h1>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
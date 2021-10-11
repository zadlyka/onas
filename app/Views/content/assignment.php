<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h1>My Assignments</h1>
    <div class="row">
        <?php foreach ($assign as $data) : ?>
            <div class="col-lg-3 mb-3">
                <a href="<?= base_url('assign/detail/' . $data['assignid']); ?>" class="text-decoration-none">
                    <div class="card h-100 text-dark bg-light mb-3 p-5">
                        <div class="card-header bg-danger text-center text-white rounded">
                            <h5><?= $data['namaassign']; ?></h5>
                        </div>
                        <div class="card-body">
                            <strong>
                                <p class="card-title"><?= $data['assignid']; ?></p>
                            </strong>
                            <p class="card-text"><?= $data['keterangan']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

        <div class="col-lg-3 mb-3">
            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#createassignModal">
                <div class="card h-100 text-dark text-center bg-light mb-3 justify-content-center align-self-center p-5">
                    <h1><i class="fas fa-plus-square"></i></h1>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="mt-2">Online Assignments Application</h1>
            <p class="lead">Aplikasi web pengumpulan tugas.</p>
            <p>lihat <a href="<?= base_url('assign/downloadpetunjuk'); ?>">petunjuk penggunaan</a> bagi pengguna baru.</p>
        </div>
        <div class="col-lg-6">
            <img src="<?= base_url('assets/home.svg'); ?>" alt="" width="500px" class="img_home mx-auto d-block">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6">
            <a <?php if ($statuslogin == 'login') {
                    echo 'href="" data-bs-toggle="modal" data-bs-target="#createroomModal"';
                } else {
                    echo 'href="' . base_url('room') . '"';
                }
                ?> class="text-decoration-none">
                <div class="card text-dark bg-light mb-3 p-5">
                    <div class="card-header">Create Room</div>
                    <div class="card-body">
                        <p class="card-text">Buat room untuk kumpulan assignments</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mb-2">
            <a <?php if ($statuslogin == 'login') {
                    echo 'href="" data-bs-toggle="modal" data-bs-target="#createassignModal"';
                } else {
                    echo 'href="' . base_url('assign') . '"';
                }
                ?> class="text-decoration-none">
                <div class="card text-white bg-danger mb-3 p-5">
                    <div class="card-header">Create Assignments</div>
                    <div class="card-body">
                        <p class="card-text">Buat assignments untuk mengupload tugas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
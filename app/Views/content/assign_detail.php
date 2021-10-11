<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8 mb-3">
            <h1><?= $assign['namaassign']; ?></h1>
            <h4><?= $assign['namaroom']; ?></h4>
            <h6>Nilai : <?= $assign['nilai']; ?></h6>

            Keterangan : <?= $assign['keterangan']; ?>
            <br>
            Code Room: <strong><?= $assign['roomid']; ?></strong>
            <br>
            Final File : <?= $assign['file']; ?>
            <br>
            <a href="" class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#uploadfileModal">Upload File</a>
        </div>
        <div class="col-lg-4">
            <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#editassignModal"><i class="fas fa-edit"></i></a>
            <a class="btn btn-primary" href="<?= base_url('assign/delete/' . $assign['assignid']); ?>" role="button" onclick="return confirm('Apakah Yakin Untuk Menghapus Room ?')"><i class="fas fa-trash"></i></a>
        </div>
    </div>

    <div class="row table-responsive">
        <h6>File :</h6>
        <table class="table table-bordered text-center">
            <thead class="table-warning">
                <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">File</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($file as $data) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $data['namafile']; ?></td>
                        <td><?= $data['keterangan']; ?></td>
                        <td>
                            <a class="btn btn-light" href="<?= base_url('assign/downloadfile/' . $data['fileid']); ?>" role="button">Download</a>
                            <a class="btn btn-light" href="<?= base_url('assign/deletefile/' . $data['fileid']); ?>" role="button" onclick="return confirm('Apakah Yakin Untuk Menghapus Assignment?')">Hapus</a>
                            <a class="btn btn-warning" href="<?= base_url('assign/setfilefinal/' . $data['fileid']); ?>" role="button" onclick="return confirm('Apakah yakin untuk menjadikan file ini sebagai final file ?')">Set Final</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editassignModal" tabindex="-1" aria-labelledby="editassignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editassignModalLabel">Edit Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('assign/edit'); ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaassign" class="form-label">Nama Assignment</label>
                        <input name="nama" type="text" value="<?= $assign['namaassign']; ?>" class="form-control" id="namaassign" placeholder="Nama Assignment">
                    </div>
                    <div class="mb-3">
                        <label for="keteranganassign" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keteranganassign" placeholder="Isi Keterangan"><?= $assign['keterangan']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="coderoomassign" class="form-label">Code Room</label>
                        <input name="code" type="text" value="<?= $assign['roomid']; ?>" class="form-control" id="coderoomassign" placeholder="Code Room">
                    </div>

                    <input type="hidden" name="assignid" value="<?= $assign['assignid']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadfileModal" tabindex="-1" aria-labelledby="uploadfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadfileModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('assign/upload'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" name="file" class="form-control" id="uploadfile">
                        <small class="text-danger">File tidak boleh melebihi ukuran 4 mb</small>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keteranganfileupload" placeholder="isi keterangan"></textarea>
                    </div>
                    <input type="hidden" name="assignid" value="<?= $assign['assignid']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>
<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8 mb-3">
            <h1><?= $room['namaroom']; ?></h1>
            Keterangan : <?= $room['keterangan']; ?>
            <br>
            Code Room: <strong><?= $room['roomid']; ?></strong>
        </div>
        <div class="col-lg-4">
            <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#editroomModal"><i class="fas fa-edit"></i></a>
            <a class="btn btn-primary" href="<?= base_url('room/delete/' . $room['roomid']); ?>" role="button" onclick="return confirm('Apakah Yakin Untuk Menghapus Room ?')"><i class="fas fa-trash"></i></a>
        </div>
    </div>

    <div class="row table-responsive">
        <h6>List Assignments :</h6>
        <table class="table table-bordered text-center">
            <thead class="table-warning">
                <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Assignments</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Pengirim</th>
                    <th scope="col">Nilai</th>
                    <th scope="col">File</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($assign as $data) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $data['namaassign']; ?></td>
                        <td><?= $data['keterangan']; ?></td>
                        <td><?= $data['pengirim']; ?></td>
                        <td><?= $data['nilai']; ?></td>
                        <td><?= $data['file']; ?></td>
                        <td><?= $data['updated_at']; ?></td>
                        <td>

                            <?php if ($data['file']) {
                                echo '
                                    <a class="btn btn-light" href="' . base_url('assign/downloadfinalfile/' . $data['assignid']) . '" role="button">Download</a>
                                ';
                            } ?>
                            <a class="btn btn-light" href="<?= base_url('assign/deleteassign/' . $data['assignid'] . '/' . $data['roomid']); ?>" role="button" onclick="return confirm('Apakah Yakin Untuk Menghapus Assignment?')">Hapus</a>
                            <a class="btn btn-light" id="nilaibtn" data-roomid="<?= $data['roomid']; ?>" data-assignid="<?= $data['assignid']; ?>" data-nilai="<?= $data['nilai']; ?>" href="#" role="button" data-bs-toggle="modal" data-bs-target="#nilaiModal">Nilai</a>
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
<div class="modal fade" id="editroomModal" tabindex="-1" aria-labelledby="editroomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editroomModalLabel">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('room/edit'); ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editamaroom" class="form-label">Nama Room</label>
                        <input value="<?= $room['namaroom']; ?>" type="text" name="nama" class="form-control" id="editnamaroom" placeholder="Nama Room">
                    </div>
                    <div class="mb-3">
                        <label for="editketeranganroom" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="editketeranganroom" placeholder="Isi Keterangan"><?= $room['keterangan']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
                <input type="hidden" name="roomid" value="<?= $room['roomid']; ?>">
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nilaiModalLabel">Nilai Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('assign/setnilai'); ?>" method="POST" id="formnilai">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nilaiform" class="form-label">Nilai</label>
                        <input type="text" class="form-control" id="nilaiform" placeholder="100" name="nilai">
                    </div>
                </div>

                <input type="hidden" id="assignidnilai" name="assignid" value="">
                <input type="hidden" id="roomidnilai" name="roomid" value="">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>